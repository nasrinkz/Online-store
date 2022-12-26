$("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 7000 ); // 7 secs

});
// $(function () {
//     $('#example1').DataTable({
//         "paging": false,
//         "lengthChange": false,
//         "searching": false,
//         "ordering": true,
//         "info": false,
//         "autoWidth": false,
//         "responsive": true,
//     });
// });
function changeShow(placeholder) {
        var nextStatus = $(placeholder).attr('id');
        $.ajax({
            url: $(placeholder).attr('rel')+nextStatus,
            type: "GET",
            success: function (response) {
                if(document.getElementById(response).className=="fa fa-check text-success"){
                    document.getElementById(response).className = "fa fa-ban text-danger";
                    document.getElementById(response).innerHTML = " Disable";
                    $(placeholder).attr('id',1); //change nextStatus value
                }else{
                    document.getElementById(response).className = "fa fa-check text-success";
                    document.getElementById(response).innerHTML = " Enable";
                    $(placeholder).attr('id',0);
                }
            }
        });
    return false;
}

$(function() {
    $('.select2').select2();

    $(document).on("click", "#pagination a,#search_btn", function() {
        //get url and make final url for ajax
        var url = $(this).attr("href");
        var append = url.indexOf("?") == -1 ? "?" : "&";
        var finalURL = url + append + $("#searchform").serialize();

        //set to current url
        window.history.pushState({}, null, finalURL);

        $.get(finalURL, function(data) {

            $("#pagination_data").html(data);

        });
        return false;
    })
});

