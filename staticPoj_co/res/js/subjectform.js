
$(function(){
    //年级学科级联
    $("#grade").change(function(){
        var grade=$(this).val();
        var subObj=gradesubjectCodeMap[grade].subjectMap;
        $("#message").html('<option value="0">请选择学科</option>');
        for(var k in subObj)
        {
            $("#message").append('<option value='+subObj[k].cn+'>'+subObj[k].cn+'</option>');
        }

    });
     $('#message').on('click', function(){
        // console.log('here', event);
        var val = $('#grade').val();
        if(!val){
            alert('请选择年级');
        }
    })

    //学科年级介绍级联
    if($('.system-section .grade-list .item').index()==0){
        var subObj=gradeInfoCodeMap[0].subject;
        formSubinfo(subObj);
    }
    $('.system-section .grade-list .item').on('click', function(){
        $(this).addClass('select').siblings('').removeClass('select');
        var grade=$(this).index();
        var subObj=gradeInfoCodeMap[grade].subject;
        $(".system-section .subject-list .item").remove();
        for(var k in subObj)
        {
            $(".system-section .subject-list ").append('<li class=item >'+subObj[k].name+'</li>');
        }
        formSubinfo(subObj);

    })

    function formSubinfo(subObj) {
        $('.system-section .subject-list .item').on('click', function(){
            $(this).addClass('select').siblings('').removeClass('select');
            var subject=$(this).index();
            var infoObj=subObj[subject].data;
            console.log(infoObj)

            if(infoObj.length==4){
                $(".system-section .cntBox .lv5").hide();
            }else{
                $(".system-section .cntBox .lv5").show();
            }


            $(".system-section .cntBox .lv1 .para").text('');
            $(".system-section .cntBox .lv1 .level").replaceWith('<h3 class=level >'+infoObj[0].name.split(' ')[0]+'</h3>');
            $(".system-section .cntBox .lv1 .score").replaceWith('<p class=score >'+infoObj[0].name.split(' ')[1]+'</p>');
            var paralen1 = $(infoObj[0].txt);
            for (var k = 0; k < paralen1.length; k++) {
                $(".system-section .cntBox .lv1 .para").eq(k).replaceWith('<p class=para >'+infoObj[0].txt[k]+'</p>');
            }


            $(".system-section .cntBox .lv2 .para").text('');
            $(".system-section .cntBox .lv2 .level").replaceWith('<h3 class=level >'+infoObj[1].name.split(' ')[0]+'</h3>');
            $(".system-section .cntBox .lv2 .score").replaceWith('<p class=score >'+infoObj[1].name.split(' ')[1]+'</p>');
            var paralen2 = $(infoObj[1].txt);
            for (var k = 0; k < paralen2.length; k++) {
                $(".system-section .cntBox .lv2 .para").eq(k).replaceWith('<p class=para >'+infoObj[1].txt[k]+'</p>');
            }

            $(".system-section .cntBox .lv3 .para").text('');
            $(".system-section .cntBox .lv3 .level").replaceWith('<h3 class=level >'+infoObj[2].name.split(' ')[0]+'</h3>');
            $(".system-section .cntBox .lv3 .score").replaceWith('<p class=score >'+infoObj[2].name.split(' ')[1]+'</p>');
            var paralen3 = $(infoObj[2].txt);
            for (var k = 0; k < paralen3.length; k++) {
                $(".system-section .cntBox .lv3 .para").eq(k).replaceWith('<p class=para >'+infoObj[2].txt[k]+'</p>');
            }


            $(".system-section .cntBox .lv4 .para").text('');
            $(".system-section .cntBox .lv4 .level").replaceWith('<h3 class=level >'+infoObj[3].name.split(' ')[0]+'</h3>');
            $(".system-section .cntBox .lv4 .score").replaceWith('<p class=score >'+infoObj[3].name.split(' ')[1]+'</p>');
            var paralen4 = $(infoObj[3].txt);
            for (var k = 0; k < paralen4.length; k++) {
                $(".system-section .cntBox .lv4 .para").eq(k).replaceWith('<p class=para >'+infoObj[3].txt[k]+'</p>');
            }

            $(".system-section .cntBox .lv5 .para").text('');
            $(".system-section .cntBox .lv5 .level").replaceWith('<h3 class=level >'+infoObj[4].name.split(' ')[0]+'</h3>');
            $(".system-section .cntBox .lv5 .score").replaceWith('<p class=score >'+infoObj[4].name.split(' ')[1]+'</p>');
            var paralen5 = $(infoObj[4].txt);
            for (var k = 0; k < paralen5.length; k++) {
                $(".system-section .cntBox .lv5 .para").eq(k).replaceWith('<p class=para >'+infoObj[4].txt[k]+'</p>');
            }
        })
    }



});
