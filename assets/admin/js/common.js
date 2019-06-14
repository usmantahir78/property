function successtoster(title,msg){
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.success(msg, title);
    }, 1300);
}
function errortoster(title,msg){
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.error(msg, title);
    }, 1300);
}
function infotoster(title,msg){
    setTimeout(function () {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            showMethod: 'slideDown',
            timeOut: 4000
        };
        toastr.info(msg, title);
    }, 1300);
}
function isRequired(id,msg,is_span){
    var id_val = $('#'+id).val();
    if(id_val==""){
        if(is_span){
            $('#'+id+'_span').remove();
            $('#'+id).after( "<span class='text-danger' id='"+id+"_span' >"+msg+"</span>" );
        }
        errortoster('Error',msg);
        return true;
    }else{
        if(is_span){
            $('#'+id+'_span').remove();
        }
        return false;
    }

}
function errorSpan(id,msg){
    var id_val = $('#'+id).val();
    $('#'+id+'_span').remove();
    $('#'+id).after( "<span class='text-danger' id='"+id+"_span' >"+msg+"</span>" );

}