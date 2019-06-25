  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" src="js/jquery.validate.min.js"></script>
  <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
  <script type="text/javascript" src="js/jquery.mask.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
  <script src="js/index.js"></script>
  
  <script>
    $("#showmenu").click(function (e) {
      $("#menu").toggleClass("show");
    });  
  </script>
  <script>
    $(document).ready(function () {
      $('#tabelaAnimais').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "ordering": false,
        "language": {
          "decimal": "",
          "emptyTable": "Nenhuma informação encontrada.",
          "info": " ",
          "infoEmpty": " ",
          "infoFiltered": " ",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Número de posts por página _MENU_",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "search": "Procurar",
          "zeroRecords": "Nenhuma informação encontrada.",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próximo",
            "previous": "Anterior"
          }
        },
      });
      $('#tabelaProfile').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "ordering": false,
        "language": {
          "decimal": "",
          "emptyTable": "Nenhuma informação encontrada.",
          "info": " ",
          "infoEmpty": " ",
          "infoFiltered": " ",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Número de posts por página _MENU_",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "search": "Procurar",
          "zeroRecords": "Nenhuma informação encontrada.",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próximo",
            "previous": "Anterior"
          }
        },
      });
      $('#tabelaPatrocinador').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "ordering": false,
        "language": {
          "decimal": "",
          "emptyTable": "Nenhuma informação encontrada.",
          "info": " ",
          "infoEmpty": " ",
          "infoFiltered": " ",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Número de posts por página _MENU_",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "search": "Procurar",
          "zeroRecords": "Nenhuma informação encontrada.",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próximo",
            "previous": "Anterior"
          }
        },
      });
    });
    $(document).ready(function () {
      $('#listPost').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "ordering": false,
        "language": {
          "decimal": "",
          "emptyTable": "Nenhuma informação encontrada.",
          "info": " ",
          "infoEmpty": " ",
          "infoFiltered": " ",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Número de posts por página _MENU_",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "search": "Procurar",
          "zeroRecords": "Nenhuma informação encontrada.",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próximo",
            "previous": "Anterior"
          }
        },
      });
    });
$(document).ready(function () {
      $('#listPost').DataTable({
        "lengthMenu": [[5, 10, 25, -1], [5, 10, 25, "All"]],
        "ordering": false,
        "language": {
          "decimal": "",
          "emptyTable": "Nenhuma informação encontrada.",
          "info": " ",
          "infoEmpty": " ",
          "infoFiltered": " ",
          "infoPostFix": "",
          "thousands": ",",
          "lengthMenu": "Número de posts por página _MENU_",
          "loadingRecords": "Carregando...",
          "processing": "Processando...",
          "search": "Procurar",
          "zeroRecords": "Nenhuma informação encontrada.",
          "paginate": {
            "first": "Primeira",
            "last": "Última",
            "next": "Próximo",
            "previous": "Anterior"
          }
        },
      });
    });       
  </script>
</body>

</html>