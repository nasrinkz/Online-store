$("document").ready(function(){
    setTimeout(function(){
        $("div.alert").remove();
    }, 7000 ); // 7 secs

});
$(function () {
    $('#example1').DataTable({
        "paging": false,
        "lengthChange": false,
        "searching": false,
        "ordering": false,
        "info": false,
        "autoWidth": false,
        "responsive": true,
    });
});
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

    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
        $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    })

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

$(document).ready(function() {
    $('#province').on('change', function () {
        var provinceID = $(this).val();
        if (provinceID) {
            $.ajax({
                url: '/AdminDashboard/FetchCity/' + provinceID,
                type: "GET",
                data: {"_token": "{{ csrf_token() }}"},
                dataType: "json",
                success: function (data) {
                    if (data) {
                        $('#city').empty();
                        $('#city').append('<option value="" disabled selected>Select city</option>');
                        $.each(data, function (key, course) {
                            $('select[name="city_id"]').append('<option value="' + key + '">' + course.title + '</option>');
                        });
                    } else {
                        $('#city').append('<option value="" disabled selected>Select city</option>');
                    }
                }
            });
        } else {
            $('#city').empty();
        }
    });
});
//for images upload
$(function () {
    bsCustomFileInput.init();
});
function loadPreview(input, id) {
    id = id || '#preview_img';
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $(id)
                .attr('src', e.target.result)
                .width(150)
                .height(150);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
