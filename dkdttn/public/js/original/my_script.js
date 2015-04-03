/*-----------------------Menu Slide Toggle (Cancel) ------------------*/
function slideMenu(){
        var menuwidth=240;
        var status = $("#menu").css("display");
        if (status != "none"){
            //current show; doing hide menu                 
            $("#container").animate({
            left: 0
            },100);
            $("#menu").show();
            $("#menu").animate({
                left: '-120' 
            },100);  
            setTimeout(function(){
                $("#menu").hide();
            }, 100);
            $("#slideicon").html('<i class="icon-reorder"></i>');
        } else {
            //$("#slideicon").attr("src","/mobile/images/icon_close.jpg");
            $("#slideicon").html('<i class="icon-remove"></i>');
            $("#container").animate({
            left: menuwidth
            },100);
            $("#menu").show();
            $("#menu").animate({
                left: 0 
            },100);  
            
        }
}
$(document).ready(function(){
    /*
    $("#btn_home").click(function(){
        $("#sinhvien").stop().slideUp();
        $("#giangvien").stop().slideUp();
        $("#trangchu").stop().slideToggle();
    });
    $("#btn_sv").click(function(){
        $("#trangchu").stop().slideUp();
        $("#sinhvien").stop().slideToggle();
    });
    $("#btn_gv").click(function(){
        $("#trangchu").stop().slideUp();
        $("#giangvien").stop().slideToggle();
    })
    */
})

/*------------------------Footable script-----------------*/
$(function () {
	$('table').footable();
    $('#change-page-size').change(function (e) {
        e.preventDefault();
        var pageSize = $(this).val();
        $('.footable').data('page-size', pageSize);
        $('.footable').trigger('footable_initialized');
    });
});
/*----------------------- Dropdown event niên khóa ----------*/
$(document).ready(function(){
    $("#search_cn").change(function(){
        document.location.href = $(this).val();
        $("#search_nienkhoa").val()=-1;
    });
});
$(document).ready(function(){
    $("#search_nienkhoa").change(function(){
        document.location.href = $(this).val();
    });
});
/*-------------------------Search Panel Form -------------------*/
$(document).ready(function(){
    $("#tim_kiem_tong_hop").change(function(){
        var i = $(this).val();
        if (i=="timkiemdetai")
        {
            $("#type_detai").show();
        }
        else
        {
            $("#type_detai").hide();
            $("#advance").hide();
        }
    })
});
$(document).ready(function(){
    if($("#tim_kiem_tong_hop").val()=="timkiemdetai")
    {
        $("#type_detai").show();
    }        
});
$(document).ready(function(){
    $("#btn-nangcao").click(function(){
        $("#advance").slideToggle();
    })
});
/*---------------------------Back button ---------------------------*/
$(document).ready(function(){
    $("#back").click(function(){
        window.history.go(-1);
    })
});
/*----------------------------Before alert ---------------------------*/
