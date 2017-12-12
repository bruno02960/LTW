<section id="listDisplay">
  <h2> <?php echo $_GET['list'] ?> </h2>
  <div style="overflow-x:auto;">
    <table class="tasks <?= $toHide ?>" id="taskTable">
      <tbody>
        <tr>
          <th class="task arrowCursor">Task</th>
          <th class="expDate arrowCursor">Expiration Date </th>
          <th id="descriptionHead" class="task arrowCursor">Description </th>
        </tr>
        <?php
          if($list != null)
          {
            $row = 0;
            foreach( $list as $task)
            {
              $data = "";
              $diffData = 0;
              if($task['expiring']!=NULL)
              {
                $data = date('m/d/Y', $task['expiring']);
                $diffData = time() - $task['expiring'];
              }

          if($task['completed'] == "true")
            $checkMark = '&#10003;';
          else
            $checkMark = '&#10008;';

              echo '<tr>
                      <td class="task">' . strip_tags($task['title']). '</td>';
            if($diffData > 0 && $task['completed'] != "true"):
              echo '<td class="expDate"> <b>' . $data . '</b> </td>';
            else:
              echo '<td class="expDate">' . $data . ' </td>';
            endif;

            if(!empty($task['description']) && strlen($task['description']) > 30)
              echo '<td><div class = "descriptionDiv">' . $task['description'] . '</div></td>';
            else
              echo '<td><div class = "descriptionDivNotFilled">' . $task['description'] . '</div></td>';

            }
          }
        ?>
      </tbody>
    </table>
  </div>
  <br>
  <button type ="submit" onclick = "window.location='../main';"> Go Back </button> 
</section>
