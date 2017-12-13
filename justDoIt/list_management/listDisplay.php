<section id="listDisplay">
  <?php if(!empty($_GET['list'])): ?>
    <h2> <?php echo $_GET['list']?> </h2>
  <?php else: ?>
    <h2> Showing All Tasks </h2>
  <?php endif; ?>

    
  <div style="overflow-x:auto;">

  <?php 
    if($list != null)
    { 
  ?>
    <table class="tasks <?= $toHide ?>" id="taskTable">
      <tbody>
        <tr>
          <th class="task arrowCursor">Task</th>
          <th class="expDate arrowCursor">Expiration Date </th>
          <th id="descriptionHead" class="task arrowCursor">Description </th>
        </tr>
        <?php
            $row = 0;
            foreach( $list as $task)
            {
              $data = "";
              $diffData = 0;
              if($task['expiring']!=NULL)
              {
                $data = date('d-m-Y', $task['expiring']);
              }

          if($task['completed'] == "true")
            $checkMark = '&#10003;';
          else
            $checkMark = '&#10008;';

            echo '<tr>';

            if(!empty($task['title']) && strlen($task['title']) > 26)
              echo '<td><div class = "taskDiv">' . strip_tags($task['title']) . '</div> </td>';
            else
              echo '<td><div class = "taskDivNotFilled">' .strip_tags($task['title']) . '</div></td>';
    
            echo '<td class="expDate verticalTop"> <b>' . $data . '</b> </td>';

            if(!empty($task['description']) && strlen($task['description']) > 30)
              echo '<td><div class = "descriptionDiv">' . strip_tags($task['description']) . '</div></td>';
            else
              echo '<td><div class = "descriptionDivNotFilled">' . strip_tags($task['description']) . '</div></td>';

            }
        ?>
      </tbody>
    </table>
  <?php 
    } 
    else echo '<p class = "error"> No tasks found</p>';
  ?>
  </div>
  <br>
  <button type ="submit" onclick = "window.location='../main';"> Go Back </button> 
</section>
