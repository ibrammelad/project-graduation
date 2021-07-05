  $(function() {
    $('.toggle-class').change(function() {
        var status = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/changeStatus',
            data: {'status': status, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })

   $(function() {
    $('.toggle-class1').change(function() {
        var showName = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/showName',
            data: {'showName': showName, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })

   $(function() {
    $('.toggle-class2').change(function() {
        var showMail = $(this).prop('checked') == true ? 1 : 0;
        var user_id = $(this).data('id');

        $.ajax({
            type: "GET",
            dataType: "json",
            url: '/showMail',
            data: {'showMail': showMail, 'user_id': user_id},
            success: function(data){
              console.log(data.success)
            }
        });
    })
  })

  $(function() {
      $('.toggle-class3').change(function() {
          var HelpUsers = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/HelpUsers',
              data: {'HelpUsers': HelpUsers, 'user_id': user_id},
              success: function(data){
                  console.log(data.success)
              }
          });
      })
  })
  $(function() {
      $('.toggle-class4').change(function() {
          var showNearly = $(this).prop('checked') == true ? 1 : 0;
          var user_id = $(this).data('id');

          $.ajax({
              type: "GET",
              dataType: "json",
              url: '/notifyMe',
              data: {'showNearly': showNearly, 'user_id': user_id},
              success: function(data){
                  console.log(data.success)
              }
          });
      })
  })
