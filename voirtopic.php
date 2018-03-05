<?php
session_start();
$titre="Voir un sujet";
include("includes/Identifiants.php");
include("includes/Header.php");
 
//On récupère la valeur de t
$topic = (int) $_GET['t'];
 
//A partir d'ici, on va compter le nombre de messages pour n'afficher que les 15 premiers
$query=$db->prepare('SELECT topic_titre, topic_post, forum_topic.forum_id, topic_last_post,
forum_name, auth_view, auth_topic, auth_post 
FROM forum_topic 
LEFT JOIN forum_forum ON forum_topic.forum_id = forum_forum.forum_id 
WHERE topic_id = :topic');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();

if (!verif_auth($data['auth_view']))
{
    erreur(ERR_AUTH_VIEW);
}

$forum=$data['forum_id']; 
$totalDesMessages = $data['topic_post'] + 1;
$nombreDeMessagesParPage = 15;
$nombreDePages = ceil($totalDesMessages / $nombreDeMessagesParPage);

echo '<p><i>Vous êtes ici</i> : <a href="./index.php">Index du forum</a> --> 
<a href="./voirforum.php?f='.$forum.'">'.stripslashes(htmlspecialchars($data['forum_name'])).'</a>
 --> <a href="./voirtopic.php?t='.$topic.'">'.stripslashes(htmlspecialchars($data['topic_titre'])).'</a>';
echo '<h3>'.stripslashes(htmlspecialchars($data['topic_titre'])).'</h3><br /><br />';

//Nombre de pages
$page = (isset($_GET['page']))?intval($_GET['page']):1;

echo '<p>Page : ';
for ($i = 1 ; $i <= $nombreDePages ; $i++)
{
    if ($i == $page)
    {
    echo $i;
    }
    else
    {
    echo '<a href="voirtopic.php?t='.$topic.'&page='.$i.'">
    ' . $i . '</a> ';
    }
}
echo'</p>';
 
$premierMessageAafficher = ($page - 1) * $nombreDeMessagesParPage;


if (verif_auth($data['auth_post']))
{
echo'<a href="./poster.php?action=repondre&amp;t='.$topic.'">
<img src="./images/repondre.gif" alt="Répondre" title="Répondre à ce topic"></a>';
}

if (verif_auth($data['auth_topic']))
{
echo'<a href="./poster.php?action=nouveautopic&amp;f='.$data['forum_id'].'">
<img src="./images/nouveau.gif" alt="Nouveau topic" title="Poster un nouveau topic"></a>';
}

$query->CloseCursor(); 

$query=$db->prepare('SELECT post_id , post_createur , post_texte , post_time ,
membre_id, membre_pseudo, membre_inscrit, membre_avatar, membre_localisation, membre_post, membre_signature
FROM forum_post
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE topic_id =:topic
ORDER BY post_id
LIMIT :premier, :nombre');
$query->bindValue(':topic',$topic,PDO::PARAM_INT);
$query->bindValue(':premier',(int) $premierMessageAafficher,PDO::PARAM_INT);
$query->bindValue(':nombre',(int) $nombreDeMessagesParPage,PDO::PARAM_INT);
$query->execute();
 
//On vérifie que la requête a bien retourné des messages
if ($query->rowCount()<1)
{
        echo'<p>Il n y a aucun post sur ce topic, vérifiez l url et reessayez</p>';
}
else
{
        ?>
        <table>
        <tr>
        <th class="vt_auteur"><strong>Auteurs</strong></th>             
        <th class="vt_mess"><strong>Messages</strong></th>       
        </tr>
        <?php
        while ($data = $query->fetch())
        {

                     echo'<tr><td><strong>
                     <a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">
                     '.stripslashes(htmlspecialchars($data['membre_pseudo'])).'</a></strong></td>';
               
                     if ($id == $data['post_createur'])
                     {
                     echo'<td id=p_'.$data['post_id'].'>Posté à '.date('H\hi \l\e d M y',$data['post_time']).'
                     <a href="./poster.php?p='.$data['post_id'].'&amp;action=delete">
                     <img src="./images/supprimer.gif" alt="Supprimer"
                     title="Supprimer ce message" /></a>   
                     <a href="./poster.php?p='.$data['post_id'].'&amp;action=edit">
                     <img src="./images/editer.gif" alt="Editer"
                     title="Editer ce message" /></a></td></tr>';
                     }
                     else
                     {
                     echo'<td>
                     Posté à '.date('H\hi \l\e d M y',$data['post_time']).'
                     </td></tr>';
                     }
                   
                     echo'<tr><td>
                     <img src="./images/avatars/'.$data['membre_avatar'].'" alt="" />
                     <br />Membre inscrit le '.date('d/m/Y',$data['membre_inscrit']).'
                     <br />Messages : '.$data['membre_post'].'<br />
                     Localisation : '.stripslashes(htmlspecialchars($data['membre_localisation'])).'</td>';
                           
                     //Message
                     echo'<td>'.code(nl2br(stripslashes(htmlspecialchars($data['post_texte'])))).'
                     <br /><hr />'.code(nl2br(stripslashes(htmlspecialchars($data['membre_signature'])))).'</td></tr>';
                     } //Fin de la boucle ! \o/
                     $query->CloseCursor();
            
                     ?>
            </table>
            <?php
        echo '<p>Page : ';
        for ($i = 1 ; $i <= $nombreDePages ; $i++)
        {
                if ($i == $page)
                {
                echo $i;
                }
                else
                {
                echo '<a href="voirtopic.php?t='.$topic.'&amp;page='.$i.'">
                ' . $i . '</a> ';
                }
        }
        echo'</p>';
       
        $query=$db->prepare('UPDATE forum_topic
        SET topic_vu = topic_vu + 1 WHERE topic_id = :topic');
        $query->bindValue(':topic',$topic,PDO::PARAM_INT);
        $query->execute();
        $query->CloseCursor();

}
?>
<div id="footer">
<?php
echo '<h3>Options de modération</h3>';

$query=$db->prepare('SELECT auth_view, auth_modo, auth_post FROM forum_forum WHERE forum_id=:forum');
$query->bindValue(':forum',$forum,PDO::PARAM_INT);
$query->execute();
$data=$query->fetch();
$view = (verif_auth($data['auth_view']))? 'Vous pouvez <b>voir</b> ce topic':'Vous <i>ne</i> pouvez <i>pas</i> <b>voir</b> ce topic';
$post = (verif_auth($data['auth_post']))? 'Vous pouvez <b>répondre</b> à ce topic':'Vous <i>ne</i> pouvez <i>pas</i> <b>répondre</b> à ce topic';
$modo = (verif_auth($data['auth_modo']))? 'Vous pouvez <b>modérer</b> ce topic':'Vous <i>ne</i> pouvez <i>pas</i> <b>modérer</b> ce topic';
echo '<p>'.$view.'<br />'.$post.'<br />'.$modo.'</p>';
$query->CloseCursor();
?>
</div>         
</div>
</body>
</html>
