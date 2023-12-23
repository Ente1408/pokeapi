import './bootstrap';
import '../sass/app.scss'

import * as bootstrap from 'bootstrap';


$(document).ready(function(){
        let poke =   iniciar();
        iniciar_favoritos();
$('#pokeapi').on('click','.poner', function(){
    let fila= $(this).closest("tr"); //Tomar los valores de la fila que vamos a poner
    let seleccion =  poke.row(fila).data();
    $.ajax(
        {
          "url" : url+'favorite',
          "type": "POST",
          "async": false,
          "data":{
            "name": seleccion['name'],
            "_token": $('input[name="_token"]').val()
          }
        })
          .done(function(dat) {
           let  datas = $.parseJSON(dat);
            if(datas['status'] == 0){
                alert( "error")
            }else{
                poke =   iniciar();
            }

          })
          .fail(function(data) {
            return alert( "error");
          });
});
$('#pokeapi').on('click','.quitar', function(){
    if(!confirm('Seguro que quieres quitar este pokemon de tus facoritos?')){
        return false;
    }
    let fila= $(this).closest("tr"); //Tomar los valores de la fila que vamos a poner
    let seleccion =  poke.row(fila).data();
    $.ajax(
        {
          "url" : url+'favorite/'+ seleccion['name'],
          "type": "DELETE",
          "async": false,
          "data":{
            "_token": $('input[name="_token"]').val()
          }
        })
          .done(function(dat) {
           let  datas = dat;
            if(datas.status == 0 ){
                return alert(datas.msg);
            }else{
                poke =   iniciar();
            }

          })
          .fail(function(data) {
            return alert( "error");
          });
});

});
function iniciar_favoritos(){
    $('#poke_list').DataTable({
        "destroy":true,
        "ajax": {
            "url": url+'favorite',
            "type": "GET",
        },
        'columns':[
            {"data":"name"},

        ],
    });
}
function iniciar(){
    let datas;
    $.ajax(
        {
          "url" : url+'favorite',
          "type": "GET",
          "async": false
        })
          .done(function(dat) {
            datas = $.parseJSON(dat);
          })
          .fail(function(data) {
            return alert( "error");
          });

   let poke =  $('#pokeapi').DataTable({
        "destroy":true,
        "ajax": {
            "url": "https://pokeapi.co/api/v2/pokemon?limit=100",
            "type": "GET",
            "dataSrc":"results"
        },
        'columns':[
            {"data":"name"},
            {"data":"name",
                render: function (data, type) {
                    if(datas['status'] == '0' || datas['status'] == 0){
                        return '<i class="fas fa-heart poner"></i>';
                    }
                    if(datas['data'].find((da) => da.name === data)){
                        return '<i class="fas fa-heart quitar"></i>';
                    }
                        return '<i class="far fa-heart poner"></i>';
                },},
        ],
    });

    return poke;
}
