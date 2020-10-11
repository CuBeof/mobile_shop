$(document).ready(function(){
  
    // hide search results on clicking anywhere else
    $('html').click(function(){
      $('#search-result-dropdown').hide();
    });
    
    // on pressing ENTER, alternatively bind on keyup
    $('#search-form').on('keyup',function(e) {
        // clear results
        $('#search-result-dropdown > ul').html("");
        
        // fetch data
        $.ajax({
          url: "admin/ajax.php",
          method: 'get',
          data: {
            type: "search",
            q: $(this).val()
          },
          success: function(result){
                $.each( result, function( key, value ) {
                    $('#search-result-dropdown > ul').append(`<li class="list-group-item"><a href="index.php?page_layout=product&prd_id=${value['prd_id']}">${value['prd_name']}</a></li>`)
                });
                
                // show results if not empty
                if($('#search-result-dropdown > ul').html() !=="" ){
                    $('#search-result-dropdown').show();
                }
        },
          error: function(XMLHttpRequest, textStatus, errorThrown) { 
            alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }       
        });
    });
  });