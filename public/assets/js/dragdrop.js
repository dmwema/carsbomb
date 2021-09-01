$(function() {  

    $("#sortable tbody").sortable(
      {
        cursor: "move",
        item: "tr",
        opacity: .7,
        placeholder: "sortable-placeholder",
        helper: function(e, tr)
        {
          var $originals = tr.children();

          var $helper = tr.clone();
          
          $helper.children().each(function(index)
          {
            // Set helper cell sizes to match the original sizes
            $(this).width($originals.eq(index).width());
          });
          return $helper;
        }, 
        update: function () {
          var order = [];
          var token = $('meta[name="csrf-token"]').attr('content');
          $('tr.row-game').each(function(index, element) {
            order.push({
              id: $(this).attr('data-id'),
              position: index+1
            });
            console.log($(this).find("td.order-position").text(index+1))
          });
    
          $.ajax({
            type: "POST", 
            dataType: "json", 
            url: "/edit-position",
            data: {
              order: order,
              _token: token
            },
            success: function(response) {
                if (response.status == "success") {
                  console.log(response);
                } else {
                  console.log(response);
                }
            }
          });
        }
      }
    );
  });