function fillInviteForm(UserList)
{
  var userID = (UserList.id.substr(0,UserList.id.indexOf('/'))).substr(6);
  var listID = UserList.id.split('/')[1].substr(6);

  document.getElementById("userID").value = userID;
  document.getElementById("listID").value = listID;
  document.getElementById("inviteUserForm").submit();
}