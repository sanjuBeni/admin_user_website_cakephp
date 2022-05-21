$(document).ready(function(){

    let user = $("#user");

    function selectUsers()
    {
        $.ajax({
            url : "<?= Router::url(['controller' => 'users', 'action' => 'searchUser']) ?>",
            type : "post",
            dataType : 'JSON',
            success : function(data){
                console.log(data);
                // let selectData = `<option>${data}</option>`;
                // user.html = selectData;
            }
        });
    }
    console.log(user);
    selectUsers();

  
});