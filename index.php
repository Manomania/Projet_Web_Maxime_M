<?php

session_start();
$titre = "Klipay - Index";
include("includes/Identifiants.php");
include("includes/Header.php");
include("includes/Menu.php");

//Initialisation de deux variables
$totaldesmessages = 0;
$categorie = NULL;

//Cette requête permet d'obtenir tout sur le forum
$query=$db->prepare('SELECT cat_id, cat_nom, forum_forum.forum_id, forum_name, forum_desc, forum_post, forum_topic, 
auth_view, forum_topic.topic_id,  forum_topic.topic_post, post_id, post_time, post_createur, membre_pseudo, membre_id 
FROM forum_categorie
LEFT JOIN forum_forum ON forum_categorie.cat_id = forum_forum.forum_cat_id
LEFT JOIN forum_post ON forum_post.post_id = forum_forum.forum_last_post_id
LEFT JOIN forum_topic ON forum_topic.topic_id = forum_post.topic_id
LEFT JOIN forum_membres ON forum_membres.membre_id = forum_post.post_createur
WHERE auth_view <= :lvl 
ORDER BY cat_ordre, forum_ordre DESC');
$query->bindValue(':lvl',$lvl,PDO::PARAM_INT);
$query->execute();
?>

<div class="Forums">
<table>

<?php

while($data = $query->fetch())
{
    //On affiche chaque catégorie
    if( $categorie != $data['cat_id'] )
    {  
        $categorie = $data['cat_id'];
        ?>
        <tr>
            <th></th>
            <th>
                <strong>
                <?php echo stripslashes(htmlspecialchars($data['cat_nom'])); ?>
                </strong>
            </th>             
            <th class="nombremessages"><strong>Sujets</strong></th>       
            <th class="nombresujets"><strong>Messages</strong></th>       
            <th class="derniermessage"><strong>Dernier message</strong></th>   
        </tr>
        <?php
    }
if (verif_auth($data['auth_view']))
{
    //Affichage des forums
}
    else
{
    ?>
    <td class="nombremessages">Pas de message</td></tr>
    <?php
}

    // Affichage des description,nb de réponse etc

    echo'<tr><td><img src="./images/message.png" alt="message" /></td>
    <td class="titre"><strong>
    <a href="./voirforum.php?f='.$data['forum_id'].'">
    '.stripslashes(htmlspecialchars($data['forum_name'])).'</a></strong>
    <br />'.nl2br(stripslashes(htmlspecialchars($data['forum_desc']))).'</td>
    <td class="nombresujets">'.$data['forum_topic'].'</td>
    <td class="nombremessages">'.$data['forum_post'].'</td>';

    if (!empty($data['forum_post']))
    {
         //Selection dernier message
	 $nombreDeMessagesParPage = 15;
         $nbr_post = $data['topic_post'] +1;
	 $page = ceil($nbr_post / $nombreDeMessagesParPage);
		 
         echo'<td class="derniermessage">
         '.date('H\hi \l\e d/M/Y',$data['post_time']).'<br />
         <a href="./voirprofil.php?m='.stripslashes(htmlspecialchars($data['membre_id'])).'&amp;action=consulter">'.$data['membre_pseudo'].'  </a>
         <a href="./voirtopic.php?t='.$data['topic_id'].'&amp;page='.$page.'#p_'.$data['post_id'].'">
         <img src="./images/go.gif" alt="go" /></a></td></tr>';

     }
     else
     {
         echo'<td class="nombremessages">Pas de message</td></tr>';
     }

     //Cette variable stock le nombre de messages, on la met à jour
     $totaldesmessages += $data['forum_post'];

}

$query->CloseCursor();
?>

</table>
</div>
</div>
<div class ="total_mess">
<i>Vous êtes ici : </i><a href ="./index.php">Index du forum</a>
<?php
//On compte les membres
$TotalDesMembres = $db->query('SELECT COUNT(*) FROM forum_membres')->fetchColumn();
$query->CloseCursor();	
$query = $db->query('SELECT membre_pseudo, membre_id FROM forum_membres ORDER BY membre_id DESC LIMIT 0, 1');
$data = $query->fetch();
$derniermembre = stripslashes(htmlspecialchars($data['membre_pseudo']));

echo'<p>Le total des messages du forum est <strong>'.$totaldesmessages.'</strong>.<br />';
echo'Le site et le forum comptent <strong>'.$TotalDesMembres.'</strong> membres.<br />';
echo'Le dernier membre est <a href="./voirprofil.php?m='.$data['membre_id'].'&amp;action=consulter">'.$derniermembre.'</a>.</p>';
$query->CloseCursor();
?>
</div>
<div id="footer">';
    <h6>En cliquant sur
        <a href="register.php">Créer un compte</a>, vous acceptez nos
        <a href="URL">Conditions</a> et indiquez que vous avez lu notre
        <a href="URL">Politique d’utilisation des données</a>, y compris notre
        <a href="URL">Utilisation des cookies</a>. Vous pourrez vous désabonner à tout moment.
    </h6>
</div>
</body>
</html>


