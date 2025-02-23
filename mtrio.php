<?php 
    include "../data/data.php";
?>

<ul>
<div class="character-container">
    <?php foreach ($posters as $poster): ?>
        <li>
         <div class="character-item">
         <p class="name"><strong>Name:</strong> <?php echo $poster['name']; ?></p>
            <img src="<?php echo $poster['image']; ?>" alt="<?php echo $poster['name']; ?>" width="100">
            
           <p> <strong>Role:</strong> <?php echo $poster['role']; ?></p>
            <p><strong>Bounty:</strong> <?php echo $poster['bounty']; ?></p>
            </div>
        </li>
        <br>
    <?php endforeach; ?>
    </div>
</ul>




