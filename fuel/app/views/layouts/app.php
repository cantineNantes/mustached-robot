<html>

<body>

	<?php if(isset($messages) and count($messages)>0): ?>
      <div class="message">
         <ul>
         <?php
            foreach($messages as $message)
            {
               echo '<li>', $message,'</li>';
            }
         ?>
         </ul>
      </div>
     <?php endif; ?>

	<?php echo $content; ?>

</body>

</html>