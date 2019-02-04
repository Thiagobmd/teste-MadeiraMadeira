$(document).ready(function(){
	
	// chamo a função responsavel por gerar a lista de telefones
	fetch_data();

	function fetch_data()
	{
        
          
		$.ajax({
            type: "GET",
            url:"http://localhost/teste-madeira/admin/dist/php/fetch.php",
            dataType: 'json',
			success: function(data) {

                let ano2017count = data.slice(-1)[0].ano2017;
                let ano2018count = data.slice(-1)[0].ano2018;
                let ano2019count = data.slice(-1)[0].ano2019;

                window.localStorage.setItem('ano2017count', ano2017count);
                window.localStorage.setItem('ano2018count', ano2018count);
                window.localStorage.setItem('ano2019count', ano2019count);
                
                //console.log(data);
                $(".total-contatos").html(data[0].count_numbers);

                

                $(".2017count strong").html(ano2017count);
                $(".2018count strong").html(ano2018count);
                $(".2019count strong").html(ano2019count);

              
            
              },
              error: function () {
                alert('error');
              }
		})
	}

});