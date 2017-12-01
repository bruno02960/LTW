<section id="listDisplay">

<h2> <?php echo $_GET['list'] ?> </h2>

<table class="tasks <?= $toHide ?>" id="taskTable">
<tbody>
  <tr>
    <th class="id">ID</th>
    <th class="status arrowCursor">Status</th>
    <th class="task arrowCursor">Task</th>
    <th class="expDate arrowCursor">Expiration Date </th>
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
                <td class="id">' . $task['id']. '</td>
                <td class="status">' . $checkMark. '</td>
                <td class="task">' . strip_tags($task['title']). '</td>';
      if($diffData > 0 && $task['completed'] != "true"):
        echo '<td class="expDate"> <b>' . $data . '</b> </td>';
      else:
        echo '<td class="expDate">' . $data . ' </td>';
      endif;
        $taskRow = $task['id'];
      }
    }
    else
      $taskRow = null;
  ?>
</tbody>
</table>
</section>
