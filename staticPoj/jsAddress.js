var addressInit = function(_carea,_cmbProvince, _cmbCity, _cmbArea,defaultarea1, defaultProvince, defaultCity, defaultArea)  
{  
    var area=document.getElementById(_carea);  
    var cmbProvince = document.getElementById(_cmbProvince);  
    var cmbCity = document.getElementById(_cmbCity);  
    var cmbArea = document.getElementById(_cmbArea);  
    function cmbSelect(cmb, str)  
    {  
        for(var i=0; i<cmb.options.length; i++)  
        {  
            if(cmb.options[i].value == str)  
            {  
                cmb.selectedIndex = i;  
                return;  
            }  
        }  
    }  
    function cmbAddOption(cmb, str, obj)  
    {  
        var option1 = document.createElement("option");
        option1.innerHTML = str;
        option1.value = str;
        option1.obj = obj;
        cmb.options.add(option1);
    }  
      
    function changeCity()  
    {  
        cmbArea.options.length = 0;  
        if(cmbCity.selectedIndex == -1)return;  
        var item = cmbCity.options[cmbCity.selectedIndex].obj;  
        for(var i=0; i<item.areaList.length; i++)  
        {  
            cmbAddOption(cmbArea, item.areaList[i], null);  
        }  
        cmbSelect(cmbArea, defaultArea);  
    }  
    function changeProvince()  
    {  
        cmbCity.options.length = 0;  
        cmbCity.onchange = null;  
        if(cmbProvince.selectedIndex == -1)return;  
          
        var item = cmbProvince.options[cmbProvince.selectedIndex].obj;  
        for(var i=0; i<item[cmbProvince.selectedIndex].cityList.length; i++)  
        {  
            cmbAddOption(cmbCity, item[cmbProvince.selectedIndex].cityList[i].name, item[cmbProvince.selectedIndex].cityList[i]);  
        }  
        cmbSelect(cmbCity, defaultCity);  
        changeCity();  
        cmbCity.onchange = changeCity;  
    }  
    function changeArea()  
    {  
        cmbProvince.options.length = 0;  
        cmbProvince.onchange = null;  
        if(area.selectedIndex == -1)return;  
        var item=area.options[area.selectedIndex].obj;  
        for(var i=0;i<item.Allcity.length;i++)  
        {  
            cmbAddOption(cmbProvince,item.Allcity[i].name,item.Allcity);  
        }  
        cmbSelect(cmbProvince,defaultProvince);  
        changeProvince();  
        cmbProvince.onchange=changeProvince;  
    }  
          
          
          
          
    for(var i=0; i<provinceList.length; i++)  
    {  
    //alert(provinceList[i].Allcity[0].name);  
    //var mess=provinceList[i].Allcity.join('--');  
    //alert(mess);  
        cmbAddOption(area, provinceList[i]._area, provinceList[i]);  
    }  
      
    cmbSelect(area, defaultarea1);  
    changeArea();  
    area.onchange = changeArea;  
}  
  
var provinceList = [
    {_area: "一年级上", Allcity: [

            {
                name: '语文', cityList: [
                    {name: '第一单元', areaList: ['1、天地人', '2、金木水火土', '3、口耳目', '4、日月水火', '5、对韵歌', '6、语文园地一（口语：我说你做）']},
                    {
                        name: '第二单元',
                        areaList: ['1、a o e', '2、i u ü y w', '3、b p m f', '4、d t n l', '5、g k h', '6、j q x', '7、z c s', '8、zh ch sh r', '9、语文园地二']
                    },
                    {
                        name: '第三单元',
                        areaList: ['9、ai ei ui', '10、ao ou iu', '11、ie üe er', '12、an en in un ün', '13、ang eng ing ong', '14、语文园地三']
                    },
                    {name: '第四单元', areaList: ['1、秋天', '2、小小的船', '3、江南', '4、四季', '5、语文园地四（口语：我们做朋友）']},
                    {name: '第五单元', areaList: ['6、画', '7、大小多少', '8、小书包', '9、日月明', '10、升国旗', '语文园地五']},
                    {name: '第六单元', areaList: ['5、影子', '6、比尾巴', '7、青蛙写诗', '8、雨点儿', '语文园地六（口语：用多大的声音）']},
                    {name: '第七单元', areaList: ['9、明天要远足', '10、大还是小', '11、项链', '语文园地七']},
                    {name: '第八单元', areaList: ['12、雪地里的小画家', '13、乌鸦喝水', '小蜗牛', '语文园地八（口语：小兔运南瓜）']},
                    {name: '专题训练', areaList: []},
                    {name: '综合测试', areaList: []}
                ]
            },

            {
                name: '数学', cityList: [
                    {name: '第一单元', areaList: ['数一数']
                    },
                    {name: '第二单元', areaList: ['比一比']},
                    {name: '第三单元', areaList: ['分一分']
                    },
                    {name: '第四单元', areaList: ['认位置']},
                    {name: '第五单元', areaList: ['认识10以内的数']
                    },
                    {name: '第六单元', areaList: ['认识图形（一）（有趣的拼搭）']},
                    {name: '第七单元', areaList: ['分与合']},
                    {name: '第八单元', areaList: ['10以内的加法和减法（丰收的果园）']},
                    {name: '第九单元', areaList: ['认识11~20各数']},
                    {name: '第十单元', areaList: ['20以内的进位加法']},
                    {name: '第十一单元', areaList: ['期末复习']},
                    {name: '专题训练', areaList: []},
                    {name: '综合测试', areaList: []}
                ]
            }
        ]
    },


    {_area:"一年级下",Allcity:[

            {
                name: '语文', cityList: [
                    {name: '第一单元', areaList: ['1、春夏秋冬', '2、姓氏歌', '3、小青蛙', '4、猜字谜', '语文园地一（口语：听故事，讲故事）']},
                    {name: '第二单元', areaList: ['1、吃水不忘挖井人', '2、我多想去看看', '3、一个接一个', '4、四个太阳', '语文园地二']},
                    {name: '第三单元', areaList: ['5、小公鸡和小鸭子', '6、树和喜鹊', '7、怎么都快乐', '语文园地三（口语：请你帮个忙）']},
                    {name: '第四单元', areaList: ['8、静夜思', '9、夜色', '10、端午粽', '峄城区', '11、彩虹', '语文园地四']},
                    {name: '第五单元', areaList: ['5、动物儿歌', '6、古对今', '7、操场上', '8、人之初', '语文园地五（口语：打电话）']},
                    {name: '第六单元', areaList: ['12、古诗二首（池上 小池）', '13、荷叶圆圆', '14、要下雨了', '语文园地六']},
                    {name: '第七单元', areaList: ['15、文具的家', '16、一分钟', '17、动物王国开大会', '18、小猴子下山', '语文园地七（口语：一起做游戏）']},
                    {name: '第八单元', areaList: ['19、棉花姑娘', '20、咕咚', '21、小壁虎借尾巴', '语文园地八']},
                    {name: '专题训练', areaList: []},
                    {name: '综合测试', areaList: []}
                ]
            },

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['20以内的退位减法']},
                    {name:'第二单元', areaList:['认识图形（二）']},
                    {name:'第三单元', areaList:['认识100以内的数（我们认识的数）']},
                    {name:'第四单元', areaList:['100以内的加法和减法（一）']},
                    {name:'第五单元', areaList:['元、角、分（小小商店）']},
                    {name:'第六单元', areaList:['100以内的加法和减法（二）']},
                    {name:'第七单元', areaList:['期末复习']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]},
            ]}

            ]
    },


    {_area:"二年级上",Allcity:[


    {name:'语文', cityList:[
    {name:'第一单元', areaList:['1、小蝌蚪找妈妈','2、我是什么','3、植物妈妈有办法','4、语文园地一（口语：有趣的动物）']},
    {name:'第二单元', areaList:['1、场景歌','2、树之歌','3、拍手歌','4、田家四季歌','5、语文园地二']},
    {name:'第三单元', areaList:['4、曹冲称象','5、玲玲的画','6、一封信','7、妈妈睡了','8、语文园地三（口语：做手工）']},
    {name:'第四单元', areaList:['8、古诗二首（登鹳雀楼 望庐山瀑布）','9、黄山奇石','10、日月潭','11、葡萄沟','12、语文园地四']},
    {name:'第五单元', areaList:['12、坐井观天','13、寒号鸟','14、我要的是葫芦','语文园地五（口语：商量）']},
    {name:'第六单元', areaList:['15、大禹治水','16、朱德的扁担','17、难忘的泼水节','语文园地六（口语：看图讲故事）']},
    {name:'第七单元', areaList:['18、古诗二首（夜宿山寺 敕勒歌）','19、雾在哪里','20、雪孩子','语文园地七']},
    {name:'第八单元', areaList:['21、狐假虎威','22、狐狸分奶酪','23、纸船和风筝','24、风娃娃','语文园地八']},
    {name:'专题训练', areaList:[]},
    {name:'综合测试', areaList:[]},
    ]},

    {name:'数学', cityList:[
    {name:'第一单元', areaList:['100以内的加法和减法（三）']},
    {name:'第二单元', areaList:['平行四边形的初步认识（有趣的七巧板）']},
    {name:'第三单元', areaList:['表内乘法（一）']},
    {name:'第四单元', areaList:['表内除法（一）']},
    {name:'第五单元', areaList:['厘米和米（我们身体上的“尺”）']},
    {name:'第六单元', areaList:['表内乘法和表内除法（二）']},
    {name:'第七单元', areaList:['观察物体']},
    {name:'第八单元', areaList:['期末复习']},
    {name:'专题训练', areaList:[]},
    {name:'综合测试', areaList:[]},
    ]}

    ]
    },


    {_area:"二年级下",Allcity:[

        {name:'语文', cityList:[
        {name:'第一单元', areaList:['1、古诗二首（村居 咏柳）','2、找春天','3、开满鲜花的小路','4、邓小平爷爷植树','语文园地一（口语：注意说话的语气）']},
        {name:'第二单元', areaList:['5、雷锋叔叔，你在哪里','6、千人糕','7、一匹出色的马','语文园地二']},
        {name:'第三单元', areaList:['1、神州谣','2、传统节日','3、“贝”的故事','4、中国美食','语文园地三（口语：长大以后做什么）']},
        {name:'第四单元', areaList:['8、彩色的梦','9、枫树上的喜鹊','10、沙滩上的童话','11、我是一只小虫子','语文园地四']},
        {name:'第五单元', areaList:['12、寓言二则（亡羊补牢 揠苗助长）','13、画杨桃','14、小马过河','语文园地五（口语：图书借阅公约）']},
        {name:'第六单元', areaList:['15、古诗二首（晓出净慈寺送林子方 绝句）','16、雷雨','17、要是你在野外迷了路','18、太空生活趣事多','语文园地六']},
        {name:'第七单元', areaList:['19、大象的耳朵','20、蜘蛛开店','21、青蛙卖泥塘','22、小毛虫','语文园地七']},
        {name:'第八单元', areaList:['23、祖先的摇篮','24、当世界年纪还小的时候','25、羿射九日','语文园地八（口语：推荐一部动画片）']},
        {name:'专题训练', areaList:[]},
        {name:'综合测试', areaList:[]},
    ]},

    {name:'数学', cityList:[
        {name:'第一单元', areaList:['有余数的除法']},
        {name:'第二单元', areaList:['时、分、秒']},
        {name:'第三单元', areaList:['认识方向（测定方向）']},
        {name:'第四单元', areaList:['认识万以内的数']},
        {name:'第五单元', areaList:['分米和毫米']},
        {name:'第六单元', areaList:['两、三位数的加法和减法']},
        {name:'第七单元', areaList:['角的初步认识']},
        {name:'第八单元', areaList:['数据的收集和整理（一）（了解你的好朋友）']},
        {name:'第九单元', areaList:['期末复习']},
        {name:'专题训练', areaList:[]},
        {name:'综合测试', areaList:[]}
    ]}


    ]
    },


    {_area:"三年级上",Allcity:[

        {name:'语文', cityList:[
                {name:'第一单元', areaList:['1、大青树下的小学','2、花的学校','3、不懂就要问','4、语文园地（口语：我的暑假生活）']},
                {name:'第二单元', areaList:['4、古诗三首（山行 赠刘景文 夜书所见）','5、铺满金色巴掌的水泥道','6、秋天的雨','7、听听，秋的声音','8、语文园地',]},
                {name:'第三单元', areaList:['8、去年的树','9、那一定会很好','10、在牛肚子里旅行','11、一块奶酪','12、语文园地']},
                {name:'第四单元', areaList:['12、总也倒不了的老屋','13、胡萝卜先生的长胡子','14、不会叫的狗','15、语文园地（口语：名字里的故事）']},
                {name:'第五单元', areaList:['15、搭船的鸟','16、金色的草地','习作例文：我家的小狗 我爱故乡的杨梅','习作：我们眼中的缤纷世界']},
                {name:'第六单元', areaList:['17、古诗三首（望天门山 饮湖上初晴后雨 望洞庭）','18、富饶的西沙群岛','19、海滨小城','20、美丽的小兴安岭','习作：这儿真美','语文园地']},
                {name:'第七单元', areaList:['21、大自然的声音','22、父亲树林和鸟','23、带刺的朋友','习作：我有一个想法','语文园地（口语：身边的“小事”）']},
                {name:'第八单元', areaList:['24、司马光','25、掌声','26、灰雀','万荣县','27、手术台就是阵地','习作：那次玩得真高兴','语文园地（口语：请教）']},
                {name:'专题训练', areaList:[]},
                {name:'综合测试', areaList:[]}
    ]},

    {name:'数学', cityList:[
            {name:'第一单元', areaList:['两、三位数乘一位数']},
            {name:'第二单元', areaList:['千克和克']},
            {name:'第三单元', areaList:['长方形和正方形（周长是多少）']},
            {name:'第四单元', areaList:['两、三位数除以一位数']},
            {name:'第五单元', areaList:['解决问题的策略（间隔排列）']},
            {name:'第六单元', areaList:['平移、旋转和轴对称']},
            {name:'第七单元', areaList:['分数的初步认识（一）（多彩的“分数条”）']},
            {name:'第八单元', areaList:['期末复习']},
            {name:'专题训练', areaList:[]},
            {name:'综合测试', areaList:[]}
    ]},
    {name:'英语', cityList:[
            {name:'Unit1', areaList:['Hello!']},
            {name:'Unit2', areaList:['I\'m Liu Tao']},
            {name:'Unit3', areaList:['My friends']},
            {name:'Unit4', areaList:['My family']},
            {name:'Unit5', areaList:['Look at me!']},
            {name:'Unit6', areaList:['Colours']},
            {name:'Unit7', areaList:['Would you like a pie?']},
            {name:'Unit8', areaList:['Happy New Year!']},
            {name:'专题训练', areaList:[]},
            {name:'综合测试', areaList:[]}
    ]}

    ]
    },

    {_area:"三年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、古诗三首（绝句 惠崇春江晚景 三衢道中）','2、燕子','3、荷花','4、昆虫备忘录','习作：我的植物朋友','语文园地（口语：春游去哪儿玩）']},
                    {name:'第二单元', areaList:['5、守株待兔','6、陶罐和铁罐','7、狮子和鹿','8、池子与河流','习作：看图画，写作文','语文园地（口语：该不该实行班干部轮流制）']},
                    {name:'第三单元', areaList:['9、古诗三首（元日 清明 九月九日忆山东兄弟）','10、纸的发明','11、赵州桥','12、一幅名扬中外的画','语文园地']},
                    {name:'第四单元', areaList:['13、花钟','14、蜜蜂','15、小虾','习作：我做一下小实验','语文园地']},
                    {name:'第五单元', areaList:['16、小真的长头发','17、我变成一棵树','习作例文：一支铅笔的梦想 尾巴它有一只猫','习作：奇妙的想象']},
                    {name:'第六单元', areaList:['18、童年的水墨画','19、剃头大师','20、肥皂泡','21、我不能失信','习作：身边那些有特点的人','语文园地']},
                    {name:'第七单元', areaList:['22、我们奇妙的世界','23、海底世界','24、火烧云','习作：国宝大熊猫','语文园地（口语：劝告）']},
                    {name:'第八单元', areaList:['25、慢性子裁缝和急性子顾客','26、方帽子店','27、漏','28、枣核','自作：这样想象真有趣','语文园地']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['两位数乘两位数（有趣的乘法计算）']},
                    {name:'第二单元', areaList:['千米和吨','大武口区']},
                    {name:'第三单元', areaList:['解决问题的策略']},
                    {name:'第四单元', areaList:['混合运算（算“24”点）']},
                    {name:'第五单元', areaList:['年、月、日']},
                    {name:'第六单元', areaList:['长方形和正方形的面积']},
                    {name:'第七单元', areaList:['分数的初步认识（二）']},
                    {name:'第八单元', areaList:['小数的初步认识']},
                    {name:'第九单元', areaList:['数据的收集和整理（二）（上学时间）']},
                    {name:'第十单元', areaList:['期末复习']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['In class']},
                    {name:'Unit2', areaList:['In the library']},
                    {name:'Unit3', areaList:['Is this your pencil?']},
                    {name:'Unit4', areaList:['Where\'s the bird?']},
                    {name:'Unit5', areaList:['How old are you?']},
                    {name:'Unit6', areaList:['What time is it?']},
                    {name:'Unit7', areaList:['On the farm']},
                    {name:'Unit8', areaList:['We\'re twins!']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"四年级上",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、观潮','2、走月亮','3、现代诗二首（秋晚的江山 花牛歌）','4、繁星','5、语文园地（口语：我们与环境）']},
                    {name:'第二单元', areaList:['5、一个豆荚里的五粒豆','6、蝙蝠和雷达','7、呼风唤雨的世纪','8、蝴蝶的家','9、语文园地']},
                    {name:'第三单元', areaList:['9、古诗三首（暮江吟 题西林壁 雪梅）','10、爬山虎的脚','11、蟋蟀的住宅','12、语文园地（口语：爱护眼睛，保护视力）']},
                    {name:'第四单元', areaList:['12、盘古开天地','13、精卫填海','14、普罗米修斯','15、女娲补天','16、语文园地']},
                    {name:'第五单元', areaList:['16、风筝','17、麻雀','习作例文：爬天都峰 小木船','习作：生活万花筒']},
                    {name:'第六单元', areaList:['18、牛和鹅','19、一只窝囊的大老虎','20、陀螺','习作：记一次游戏','语文园地（口语：安慰）']},
                    {name:'第七单元', areaList:['21、古诗三首（出塞 凉州词 夏日绝句）','22、为中华之崛起而读书','23、梅兰芳蓄须','24、延安，我把你追寻','习作：写信','语文园地']},
                    {name:'第八单元', areaList:['25、王戎不取道旁李','沙坡头区','26、西门豹治邺','27、故事二则（扁鹊治病 纪昌学射）','习作：我的心儿怦怦跳','语文园地（口语：讲历史故事）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['升和毫升']},
                    {name:'第二单元', areaList:['两、三位数除以两位数（简单的周期）']},
                    {name:'第三单元', areaList:['观察物体']},
                    {name:'第四单元', areaList:['统计表和条形统计图（一）（运动与身体变化）']},
                    {name:'第五单元', areaList:['解决问题的策略']},
                    {name:'第六单元', areaList:['可能性']},
                    {name:'第七单元', areaList:['整数四则混合运算']},
                    {name:'第八单元', areaList:['垂线与平行线（怎样滚得远）']},
                    {name:'第九单元', areaList:['整理与复习']},
                    {name:'第十单元', areaList:['混合运算']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['I like dogs']},
                    {name:'Unit2', areaList:['Let\'s make a fruit salad']},
                    {name:'Unit3', areaList:['How many?']},
                    {name:'Unit4', areaList:['I can play basketball']},
                    {name:'Unit5', areaList:['Our new home']},
                    {name:'Unit6', areaList:['At the snack bar']},
                    {name:'Unit7', areaList:['How much?']},
                    {name:'Unit8', areaList:['Dolls']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"四年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、古诗词三首（宿新市徐公店、四时田园杂兴、清平乐.村居）','2、乡下人家','3、天窗','4、三月桃花水','习作：我的乐园','语文园地一（口语交际：转述）']},
                    {name:'第二单元', areaList:['5、琥珀','6、飞向蓝天的恐龙','7、新奇的纳米技术','习作：我的奇思妙想','语文园地二（口语：说新闻）']},
                    {name:'第三单元', areaList:['8、短诗三首（繁星）','9、绿','10、白桦','11、在天晴了的时候','综合性学习：轻叩诗歌大门','语文园地三']},
                    {name:'第四单元', areaList:['12、猫','13、母鸡','14、白鹅','习作：我的动物朋友','语文园地四']},
                    {name:'第五单元', areaList:['15、海上日出','16、记金华的双龙洞','习作：游（习作例文）','语文园地五']},
                    {name:'第六单元', areaList:['17、小英雄雨来','18、我们家的男子汉','19、冰雕','习作：我学会了','语文园地六（口语：朋友相处的秘诀）']},
                    {name:'第七单元', areaList:['20、古诗三首（芙蓉、塞下曲、墨梅）','21、文言文二则','22、“诺曼底”号遇难记','23、记张自忠将军','习作：我的“自画像”','语文园地七（口语：自我介绍）']},
                    {name:'第八单元', areaList:['24、宝葫芦的秘密','25、巨人的花园','26、海的女儿','习作：故事新编','语文园地八']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['平移、旋转和轴对称']},
                    {name:'第二单元', areaList:['认识多位数']},
                    {name:'第三单元', areaList:['三位数乘两位数']},
                    {name:'第四单元', areaList:['用计算器计算（一亿有多大）']},
                    {name:'第五单元', areaList:['解决问题的策略']},
                    {name:'第六单元', areaList:['运算律']},
                    {name:'第七单元', areaList:['三角形、平行四边形和梯形（多边形的内角和）']},
                    {name:'第八单元', areaList:['确定位置（数字与信息）']},
                    {name:'第九单元', areaList:['整理与复习']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Our school subjects']},
                    {name:'Unit2', areaList:['After school']},
                    {name:'Unit3', areaList:['My day']},
                    {name:'Unit4', areaList:['Drawing in the park']},
                    {name:'Unit5', areaList:['Seasons']},
                    {name:'Unit6', areaList:['Whose dress is this?']},
                    {name:'Unit7', areaList:['What\'s the matter?']},
                    {name:'Unit8', areaList:['How are you?']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"五年级上",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、白鹭','2、落花生','3、桂花雨','4、珍珠鸟','5、语文园地（口语：制定班级公约）']},
                    {name:'第二单元', areaList:['5、搭石','6、将相和','7、什么比猎豹的速度更快','8、语文园地']},
                    {name:'第三单元', areaList:['8、猎人海力布','9、牛郎织女（一）','10、牛郎织女（二）','11、语文园地（口语：讲民间故事）']},
                    {name:'第四单元', areaList:['11、古诗三首（示儿 题临安邸 己亥杂诗）','12、少年中国说','13、圆明园的毁灭','14、木笛','15、语文园地']},
                    {name:'第五单元', areaList:['15、太阳','16、松鼠','习作例文：鲸 风向袋的制作','习作：介绍一种事物']},
                    {name:'第六单元', areaList:['17、慈母情深','18、父爱之舟','19、“精彩极了”和“槽糕透了”','习作：我想对您说','语文园地（口语：父母之爱）']},
                    {name:'第七单元', areaList:['20、古诗词三首（山居秋暝 枫桥夜泊 长相思）','21、四季之美','22、鸟的天堂','23、月迹','习作：____即景','语文园地']},
                    {name:'第八单元', areaList:['24、古人谈读书','25、忆读书','26、我的“长生果”','习作：推荐一本书','语文园地（口语：我最喜欢的人物形象）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['负数的初步认识']},
                    {name:'第二单元', areaList:['多边形的面积（校园绿地面积）']},
                    {name:'第三单元', areaList:['小数的意义和性质']},
                    {name:'第四单元', areaList:['小数加法和减法']},
                    {name:'第五单元', areaList:['小数的乘法和除法（班级联欢会）']},
                    {name:'第六单元', areaList:['统计表和条形统计图（二）']},
                    {name:'第七单元', areaList:['解决问题的策略']},
                    {name:'第八单元', areaList:['用字母表示数（钉子板上的多边形）']},
                    {name:'第九单元', areaList:['整理与复习']},
                    {name:'第十单元', areaList:['确定位置（数字与信息）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Goldilocks and the three bears']},
                    {name:'Unit2', areaList:['A new student']},
                    {name:'Unit3', areaList:['Our animal friends']},
                    {name:'Unit4', areaList:['Hobbies']},
                    {name:'Unit5', areaList:['What do they do?']},
                    {name:'Unit6', areaList:['My e-friend']},
                    {name:'Unit7', areaList:['At Weekends']},
                    {name:'Unit8', areaList:['At Christmas']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },


    {_area:"五年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、古诗三首（四时田园杂兴、稚子弄冰、村晚）','2、冬阳.童年.骆驼队','3、祖父的园子','习作：那一刻，我长大了','语文园地一（口语：走进他们的童年岁月）']},
                    {name:'第二单元', areaList:['4、草船借箭','5、景阳冈','6、猴王出世','7、宝黛初会','习作：写读后感','语文园地二（口语：我们都来演一演）']},
                    {name:'第三单元', areaList:['综合性学习：遨游汉字王国、汉子真有趣、我爱你，汉字']},
                    {name:'第四单元', areaList:['8、古诗三首（凉州词、送元、秋夜）','9、军神','10、清贫','11、无名岛','习作：他陶醉了','语文园地四']},
                    {name:'第五单元', areaList:['12、人物描写一组','13、刷子李','习作：把一个人的特点写具体（习作例文）']},
                    {name:'第六单元', areaList:['14、自相矛盾','15、田忌赛马','16、跳水','习作：神奇的探险之旅','语文园地六']},
                    {name:'第七单元', areaList:['17、威尼斯的小艇','18、牧场之国','19、金字塔','习作：中国的世界文化遗产','语文园地七（口语：我是小小讲解员）']},
                    {name:'第八单元', areaList:['20、杨氏之子','21、手指','22、童年的发现','习作：漫画的启示','语文园地八（口语：我们都来讲笑话）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['简易方程']},
                    {name:'第二单元', areaList:['折线统计图（蒜叶的生长）']},
                    {name:'第三单元', areaList:['因数与倍数（和与积的奇偶性）']},
                    {name:'第四单元', areaList:['分数的意义和性质（球的反弹高度）']},
                    {name:'第五单元', areaList:['分数加法和减法']},
                    {name:'第六单元', areaList:['圆']},
                    {name:'第七单元', areaList:['解决问题的策略']},
                    {name:'第八单元', areaList:['整理与复习']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Cinderella']},
                    {name:'Unit2', areaList:['How do you come to school?']},
                    {name:'Unit3', areaList:['Asking the way']},
                    {name:'Unit4', areaList:['Seeing the doctor']},
                    {name:'Unit5', areaList:['Helping our parents']},
                    {name:'Unit6', areaList:['In the kitchen']},
                    {name:'Unit7', areaList:['Chinese festivals']},
                    {name:'Unit8', areaList:['Birthdays']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },


    {_area:"六年级上",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、草原','2、丁香结','3、古诗词三首（宿建 六月 西江月.夜行）','4、花之歌','5、语文园地']},
                    {name:'第二单元', areaList:['5、七律.长征','6、狼牙山五壮士','7、开国大典','8、灯光','9、语文园地（口语：演讲）']},
                    {name:'第三单元', areaList:['9、竹节人','10、宇宙生命之谜','11、故宫博物院','12、语文园地']},
                    {name:'第四单元', areaList:['12、桥','13、穷人','14、在柏林','15、语文园地（口语：请你支持我）']},
                    {name:'第五单元', areaList:['15、夏天里的成长','16、盼','习作例文：爸爸的计划 小站','自作：围绕中心意思写']},
                    {name:'第六单元', areaList:['17、古诗三首（浪淘沙 江南春 书湖阴先生壁）','18、只有一个地球','19、三黑和土地','20、青山不老','习作：学写倡议书','语文园地（口语：意见不同怎么办）']},
                    {name:'第七单元', areaList:['21、文言文二则（伯牙鼓琴 书戴嵩画牛）','22、月光曲','23、京剧趣谈','习作：我的拿手好戏','语文园地（口语：聊聊书法）']},
                    {name:'第八单元', areaList:['24、少年闰土','25、好的故事','6、我的伯父鲁迅先生','27、有的人——纪念鲁迅有感','习作：有你，真好','语文园地']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['长方体和正方体（表面涂色的正方体）']},
                    {name:'第二单元', areaList:['分数乘法']},
                    {name:'第三单元', areaList:['分数除法（树叶中的比）']},
                    {name:'第四单元', areaList:['解决问题的策略']},
                    {name:'第五单元', areaList:['分数四则混合运算']},
                    {name:'第六单元', areaList:['百分数（互联网的普及）']},
                    {name:'第七单元', areaList:['整理与复习']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['The king\'s new clothes']},
                    {name:'Unit2', areaList:['What a day!']},
                    {name:'Unit3', areaList:['Holiday fun']},
                    {name:'Unit4', areaList:['Then and now']},
                    {name:'Unit5', areaList:['Signs']},
                    {name:'Unit6', areaList:['Keep our city clean']},
                    {name:'Unit7', areaList:['Protect the Earth']},
                    {name:'Unit8', areaList:['Chinese New Year']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },


    {_area:"六年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、北京的春节','2、腊八粥','3、古诗三首（寒食、迢迢、十五）','4、藏戏','习作：家乡的风俗','语文园地一']},
                    {name:'第二单元', areaList:['5、鲁滨孙漂流记','6、骑鹅旅行记','7、汤姆.索亚历险记','习作：写作品梗概','语文园地二（口语：同读一本书）']},
                    {name:'第三单元', areaList:['8、匆匆','9、那个星期天','习作：让真情自然流露（习作例文）','语文园地三']},
                    {name:'第四单元', areaList:['10、古诗三首（马诗、石灰吟、竹石）','11、十六年前的回忆','12、为人民服务','13、金色的鱼钩','习作：心愿','语文园地四（口语：即兴发言）']},
                    {name:'第五单元', areaList:['14、文言文二则','15、表里的生物','16、真理诞生于一百个问号之后','17、150年后，我们这样上学','习作：插上科学的翅膀','语文园地五（口语：辩论）']},
                    {name:'第六单元', areaList:['综合性学习','古诗词诵读']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['扇形统计图']},
                    {name:'第二单元', areaList:['圆柱和圆锥']},
                    {name:'第三单元', areaList:['解决问题的策略']},
                    {name:'第四单元', areaList:['比例（面积的变化）']},
                    {name:'第五单元', areaList:['确定位置（绘制平面图）']},
                    {name:'第六单元', areaList:['正比例和反比例（大树有多高）']},
                    {name:'第七单元', areaList:['总复习1、数与代数']},
                    {name:'第八单元', areaList:['总复习2、图形与几何']},
                    {name:'第九单元', areaList:['总复习3、统计与可能性']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['The lion and the mouse']},
                    {name:'Unit2', areaList:['Good habits']},
                    {name:'Unit3', areaList:['A healthy diet']},
                    {name:'Unit4', areaList:['Road safety']},
                    {name:'Unit5', areaList:['A party']},
                    {name:'Unit6', areaList:['An interesting country']},
                    {name:'Unit7', areaList:['Sunmmer holiday plans']},
                    {name:'Unit8', areaList:['Our dreams']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"七年级上",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、春','2、济南的冬天','3、雨的四季','4、古代诗歌四首（观沧海 闻王 次北 天净）','5、写作：热爱生活，热爱写作']},
                    {name:'第二单元', areaList:['5、秋天的怀念','6、散步','7、散文诗二首（金色花 荷叶）','8、《世说新语》二则（咏雪 陈太）','9、写作：学会记事','10、综合性学习：有朋自远方来']},
                    {name:'第三单元', areaList:['9、从百草园到三味书屋','10、再塑生命的人','11、《论语》十二章','12、写作：写人要抓住特点','13、名著导读：《朝花夕拾》','14、课外古诗词诵读（峨眉 江南 行军 夜上）']},
                    {name:'第四单元', areaList:['12、纪念白求恩','13、植树的牧羊人','14、走一步，再走一步','15、诫子书','16、写作：思路要清晰','17、综合性学习：少年正是读书时']},
                    {name:'第五单元', areaList:['16、猫','17、动物笑谈','18、狼','写作：如何突出中心']},
                    {name:'第六单元', areaList:['19、皇帝的新装','20、天上的街市','21、女娲造人','22、寓言四则（赫耳 蚊子 穿井 杞人忧天）','写作：发挥联想和想象','综合性学习：文学部落','名著导读：《西游记》','课外古诗词诵读（秋词 夜雨 十一 潼关）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第1章 数学与我们同行', areaList:['1.1生活 数学','1.2活动 思考']},
                    {name:'第2章 有理数', areaList:['2.1正数与负数','2.2有理数与无理数','2.3数轴','2.4绝对值与相反数','2.5有理数的加法和减法','2.6有理数的乘法和除法','2.7有理数的乘方','2.8有理数的混合运算']},
                    {name:'第3章 代数式', areaList:['3.1字母表示数','3.2代数式','3.3代数式的值','3.4合并同类项','3.5去括号','3.6整式的加减']},
                    {name:'第4章 一元二次方程', areaList:['4.1从问题到方程','4.2解一元一次方程','4.3用一元一次方程解决问题']},
                    {name:'第5章 走进图形世界', areaList:['5.1丰富的图形世界','5.2图形的运动','5.3展开与折叠','5.4主视图、左视图、俯视图']},
                    {name:'第6章 平面图形的认识（一）', areaList:['6.1线段、射线、直线','6.2角','6.3余角、补角、对顶角','6.4平行','6.5垂直']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['This is me!']},
                    {name:'Unit2', areaList:['Let\'s play sports!']},
                    {name:'Unit3', areaList:['Welcome to our school!']},
                    {name:'Unit4', areaList:['My day']},
                    {name:'Unit5', areaList:['Let\'s celebrate!']},
                    {name:'Unit6', areaList:['Food and lifestyle']},
                    {name:'Unit7', areaList:['Shopping']},
                    {name:'Unit8', areaList:['Fashion']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"七年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、邓稼先','2、说和做','3、回忆鲁迅先生','4、孙权劝学','写作：写出人物的精神']},
                    {name:'第二单元', areaList:['5、黄河颂','6、最后一课','7、土地的誓言','8、木兰诗','写作：学习抒情','综合性学习：天下国家']},
                    {name:'第三单元', areaList:['9、阿长与《山海经》','10、老王','11、台阶','12、卖油翁','写作：抓住细节','名著导读：《骆驼祥子》','课外古诗词诵读（竹里 春夜 逢人 晚春）']},
                    {name:'第四单元', areaList:['13、叶圣陶先生二三事','14、驿路梨花','15、最苦与最乐','16、短文两篇（陋室铭 爱莲说）','写作：怎样选材','综合性学习：孝亲敬老，从我做起']},
                    {name:'第五单元', areaList:['17、紫藤萝瀑布','18、一棵小桃树','19、外国诗二首（假如生活欺骗了你 未选择的路）','20、古代诗歌五首（登幽 望岳 登飞 游山 己亥）','写作：文从字顺']},
                    {name:'第六单元', areaList:['21、伟大的悲剧','22、太空一日','23、带上她的眼睛','24、河中石兽','写作：语言简明','综合性学习：我的语文生活','名著导读：《海底两万里》','课外古诗词诵读（泊秦淮 贾生 过松 约客）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第7章 平面图形的认识（二）', areaList:['7.1探索直线平行的条件','7.2探索平行线的性质','7.3图形的平移','7.4认识三角形','7.5多边形的内角和与外角和']},
                    {name:'第8章 幂的运算', areaList:['8.1同底数幂的乘法','8.2幂的乘方与积的乘方','8.3同底数幂的除法']},
                    {name:'第9章 整式乘法与因式分解', areaList:['9.1单项式乘单项式','9.2单项式乘多项式','9.3多项式乘多项式','9.4乘法公式','9.5多项式的因式分解']},
                    {name:'第10章 二元一次方程组', areaList:['10.1 二元一次方程','10.2二元一次方程组','10.3解二元一次方程组','10.4三元一次方程组','10.5用二元一次方程组解决问题']},
                    {name:'第11章 一元一次不等式', areaList:['11.1生活中的不等式','11.2不等式的解集','11.3不等式的性质','11.4解一元一次不等式','11.5用一元一次不等式解决问题','11.6一元一次不等式组']},
                    {name:'第12章 证明', areaList:['12.1定义与命题','12.2证明','12.3互逆命题']}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Dream homes']},
                    {name:'Unit2', areaList:['Neighbours']},
                    {name:'Unit3', areaList:['Welcome to Sunshine Town!']},
                    {name:'Unit4', areaList:['Finding your way']},
                    {name:'Unit5', areaList:['Amazing things']},
                    {name:'Unit6', areaList:['Outdoor fun']},
                    {name:'Unit7', areaList:['Abilities']},
                    {name:'Unit8', areaList:['Pets']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"八年级上",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、消息二则','2、首届诺贝尔奖颁发','3、“飞天”凌空','4、一着惊海天','5、新闻采访','6、新闻写作','7、口语交际：讲述']},
                    {name:'第二单元', areaList:['5、藤野先生','6、回忆我的母亲','7、列夫.托尔斯泰','8、美丽的颜色','9、写作：学写传记','10、综合性学习：人无信不立']},
                    {name:'第三单元', areaList:['9、三峡','10、短文二篇（答谢中书书 记承天寺夜游）','11、与朱元思书','12、唐诗五首（野望黄鹤楼 使至 渡荆 钱塘湖）','13、写作：学习描写景物','14、名著导读：《红星照耀中国》','15、课外古诗词诵读（庭中 龟虽寿 赠从弟 梁甫行）']},
                    {name:'第四单元', areaList:['13、背影','14、白杨礼赞','15、散文二篇（永久的生命 我为什么而活着）','16、昆明的雨','17、写作：语言要连贯','18、综合性学习：我们的互联网时代']},
                    {name:'第五单元', areaList:['17、中国石拱桥','18、苏州园林','19、蝉','20、梦回繁华','写作：说明事物要抓住特征','口语交际：复述与转述','名著导读：《昆虫记》']},
                    {name:'第六单元', areaList:['21、《孟子》二章','22、愚公移山','23、周亚夫军细柳','24、诗词五首（饮酒 春望 雁门赤壁 渔家傲）','写作：表达要得体','综合性学习：身边的文化遗产','课外古诗词诵读（浣溪沙 采桑子 相见欢 如梦令）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第1章 全等三角形', areaList:['1.1全等图形','1.2全等三角形','1.3探索三角形全等的条件']},
                    {name:'第2章 轴对称图形', areaList:['2.1轴对称与轴对称图形','2.2轴对称的性质','2.3设计轴对称图案','2.4线段、角的轴对称性','2.5等腰三角形的轴对称性']},
                    {name:'第3章 勾股定理', areaList:['3.1勾股定理','3.2勾股定理的逆定理','3.3勾股定理的简单应用']},
                    {name:'第4章 实数', areaList:['4.1平方根','4.2立方根','4.3实数','4.4近似数']},
                    {name:'第5章 平面直角坐标系', areaList:['5.1物体位置的确定','5.2平面直角坐标系']},
                    {name:'第6章 一次函数', areaList:['6.1函数','6.2一次函数','6.3一次函数的图像','6.4用一次函数解决问题','6.5一次函数与二元一次方程','6.6一次函数、一元一次方程和一元一次不等式']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit 1', areaList:['Friends']},
                    {name:'Unit 2', areaList:['School life']},
                    {name:'Unit 3', areaList:['A day out']},
                    {name:'Unit 4', areaList:['Do it yourself']},
                    {name:'Unit 5', areaList:['Wild animals']},
                    {name:'Unit 6', areaList:['Birdwatching']},
                    {name:'Unit 7', areaList:['Seasons']},
                    {name:'Unit 8', areaList:['Natural disasters']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'物理', cityList:[
                    {name:'第一章 声现象', areaList:['一、声音是什么','二、乐音的特性','三、噪声及其控制','四、人耳听不到的声音','综合实践活动']},
                    {name:'第二章 物态变化', areaList:['一、物质的三态 温度的测量','二、汽化和液化','三、熔化和凝固','四、升华和凝华','五、水循环','综合实践活动']},
                    {name:'第三章 光现象', areaList:['一、光的色彩 颜色','二、人眼看不到的光','三、光的直线传播','四、平面镜','五、光的反射','综合实践活动']},
                    {name:'第四章 光的折射 透镜', areaList:['一、光的折射','二、透镜','三、凹透镜成像的规律','四、照相机与眼球 视力的矫正','五、望远镜与显微镜']},
                    {name:'第五章 物体的运动', areaList:['一、长度和时间的测量','二、速度','三、直线运动','四、运动的相对性']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },
    {_area:"八年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、社戏','2、回延安','3、安塞腰鼓','4、灯笼','写作：学习仿写','口语交际：应对']},
                    {name:'第二单元', areaList:['5、大自然的语言','6、阿西莫夫短文两篇','7、大雁归来','8、时间的脚印','写作：说明的顺序','综合性学习：倡导低碳生活']},
                    {name:'第三单元', areaList:['9、桃花源记','10、小石潭记','11、核舟记','12、《诗经》二首（关雎 蒹葭）','写作：学写读后感','名著导读：《傅雷家书》','课外古诗词诵读（式微 子衿 送杜 望洞）']},
                    {name:'第四单元', areaList:['13、最后一次讲演','14、应有格物致知精神','15、我一生中的重要抉择','16、庆祝奥林匹克运动复兴25周年','撰写演讲稿','举办演讲比赛']},
                    {name:'第五单元', areaList:['17、壶口瀑布','18、在长江源头各拉丹冬','19、登勃朗峰','20、一滴水经过丽江','写作：学写游记','口语交际：即席讲话']},
                    {name:'第六单元', areaList:['21、《庄子》二则','22、《礼记》二则','23、马说','24、唐诗二首（茅屋 卖炭翁）','写作：学写故事','综合性学习：以和为贵','名著导读：《钢铁是怎样炼成的》','课外古诗词诵读（题破 送友人 黄州 咏梅》']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第7章 数据的收集、整理、描述', areaList:['7.1普查与抽样调查','7.2统计图的选用','7.3频数与频率','7.4频数分布表和频数分布直方图']},
                    {name:'第8章 认识概率', areaList:['8.1确定事件与随机事件','8.2可能性的大小','8.3频率与概率']},
                    {name:'第9章 中心对称图形——平行四边形', areaList:['9.1图形的旋转','9.2中心对称与中心对称图形','9.3平行四边形','9.4矩形、菱形、正方形','9.5三角形的中位线']},
                    {name:'第10章 分式', areaList:['10.1分式','10.2分式的基本性质','10.3分式的加减','10.4分式的乘除','10.5分式方程']},
                    {name:'第11章 反比例函数', areaList:['11.1反比例函数','11.2反比例函数的图像与性质','11.3用反比例函数解决问题']},
                    {name:'第12章 二次根式', areaList:['12.1二次根式','12.2二次根式的乘除','12.3二次根式的加减']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Past and present']},
                    {name:'Unit2', areaList:['Travelling']},
                    {name:'Unit3', areaList:['Online tours']},
                    {name:'Unit4', areaList:['A good read']},
                    {name:'Unit5', areaList:['Good manners']},
                    {name:'Unit6', areaList:['Sunshine for all']},
                    {name:'Unit7', areaList:['International charities']},
                    {name:'Unit8', areaList:['A green world']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'物理', cityList:[
                    {name:'第六章 物质的物理属性', areaList:['一、物体的质量','二、测量物体的质量','三、物质的密度','四、密度知识点应用','五、物质的物理属性','综合实践活动']},
                    {name:'第七章 从粒子到宇宙', areaList:['一、走进分子世界','二、静电现象','三、探索更小的微粒','四、宇宙探秘']},
                    {name:'第八章 力', areaList:['一、力 弹力','二、重力 力的示意图','三、摩擦力','四、力的作用是相互的']},
                    {name:'第九章 力与运动', areaList:['一、二力平衡','二、牛顿第一定律','三、力与运动的关系']},
                    {name:'第十章 压强和浮力', areaList:['一、压强','二、液体的压强','三、气体的压强','四、浮力','五、物质的浮与沉','综合实践活动']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    },

    {_area:"九年级上",Allcity:[
            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、沁园春.雪','2、我爱这土地','3、乡愁','4、你是人间的四月天','5、我看','6、自由朗诵','7、尝试创作','8、名著导读：《艾青诗选》']},
                    {name:'第二单元', areaList:['6、敬业与乐业','7、就英法联军远征中国致巴特勒上尉的信','8、论教养','9、精神的三间小屋','10、写作：观点要明确','11、综合性学习']},
                    {name:'第三单元', areaList:['10、岳阳楼记','11、醉翁亭记','12、湖心亭看雪','13、诗词三首','14、课外古诗词诵读','15、写作']},
                    {name:'第四单元', areaList:['14、故乡','15、我的叔叔于勒','16、孤独之旅','17、写作','18、综合性学习']},
                    {name:'第五单元', areaList:['17、中国人失掉自信力了吗','18、怀疑与学问','19、谈创造性思维','20、创造宣言','口语交际','写作']},
                    {name:'第六单元', areaList:['21、智取生辰纲','22、范进中举','23、三顾茅庐','24、刘姥姥进大观园','课外古诗词诵读','名著导读','写作']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第1章 一元二次方程', areaList:['1.1一元二次方程','1.2一元二次方程的解法','1.3一元二次方程的根与系数的关系','1.4用一元二次方程解决问题']},
                    {name:'第2章 对称图形——圆', areaList:['2.1圆','2.2圆的对称性','2.3确定圆的条件','2.4圆周角','2.5直线与圆的位置关系','2.6正多边形与圆','2.7弧长及扇形的面积','2.8圆锥的侧面积']},
                    {name:'第3章 数据的集中趋势和离散程度', areaList:['3.1平均数','3.2中位数与众数','3.3用计算器求平均数','3.4方差','3.5用计算器求方差']},
                    {name:'第4章 等可能条件下的概率', areaList:['4.1等可能性','4.2等可能条件下的概率（一）','4.3等可能条件下的概率（二）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Know yourself']},
                    {name:'Unit2', areaList:['Colours']},
                    {name:'Unit3', areaList:['Teenage problems']},
                    {name:'Unit4', areaList:['Growing up']},
                    {name:'Unit5', areaList:['Art world']},
                    {name:'Unit6', areaList:['TV programmes']},
                    {name:'Unit7', areaList:['Films']},
                    {name:'Unit8', areaList:['Detective stories']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'物理', cityList:[
                    {name:'第十一章 简单机械和功', areaList:['一、杠杆','二、滑轮','三、功','四、功率','五、机械效率','综合实践活动']},
                    {name:'第十二章 机械能和内能', areaList:['一、动能 势能 机械能','二、内能 热传递','三、物质的比热容','四、机械能与内能的相互转化']},
                    {name:'第十三章 电路初探', areaList:['一、初识家用电器和电路','二、电路连接的基本方式','三、电流和电流表的使用','四、电压和电压表的使用','综合实践活动']},
                    {name:'第十四章 欧姆定律', areaList:['一、电阻','二、变阻器','三、欧姆定律','四、欧姆定律的应用','综合实践活动']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'化学', cityList:[
                    {name:'第一单元 走进化学世界', areaList:['课题1 物质的变化和性质','课题2 化学是一门以实验为基础的科学','课题3 走进化学实验室']},
                    {name:'第二单元 我们周围的空气', areaList:['课题1 空气','课题2 氧气','课题3 制取氧气','实验活动1 氧气的实验室制取与性质']},
                    {name:'第三单元 物质构成的奥秘', areaList:['课题1 分子和原子','课题2 原子的结构','课题3 元素']},
                    {name:'第四单元 自然界的水', areaList:['课题1 爱护水资源','课题2 水的净化','课题3 水的组成','课题4 化学式与化合价']},
                    {name:'第五单元 化学方程式', areaList:['课题1 质量守恒定律','课题2 如何正确书写化学方程式','课题3 利用化学方程式的简单计算']},
                    {name:'第六单元 碳和碳的氧化物', areaList:['课题1 金刚石、石墨和C60','课题2 二氧化碳制取的研究','课题3 二氧化碳和一氧化碳','实验活动2 二氧化碳的实验室制取与性质']},
                    {name:'第七单元 燃料及其利用', areaList:['课题1 燃烧和灭火','课题2 燃料的合理利用与开发','实验活动3 燃烧的条件']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}
        ]
    },





    {_area:"九年级下",Allcity:[

            {name:'语文', cityList:[
                    {name:'第一单元', areaList:['1、祖国啊，我亲爱的祖国','2、梅岭三章','3、短诗五首（月夜 萧红 断章 风雨吟 统一）','4、海燕','写作：学习扩写']},
                    {name:'第二单元', areaList:['5、孔乙己','6、变色龙','7、溜索','8、蒲柳人家','写作：审题立意','综合性学习：岁月如歌——我们的初中生活']},
                    {name:'第三单元', areaList:['9、鱼我所欲也','10、唐雎不辱使命','11、送东阳马生序','12、词四首（渔家傲 江城子 破阵子 满江红）','写作：布局谋篇','名著导读：《儒林外史》','课外古诗词诵读（定风波 临江仙 太常引 浣溪沙）']},
                    {name:'第四单元', areaList:['13、短文两篇（谈读书 不求甚解）','14、山水画的意境','15、无言之美','16、驱遣我们的想象','写作：修改润色','口语交际：辩论']},
                    {name:'第五单元', areaList:['17、屈原','18、天下第一楼','19、枣儿','准备与排练','演出与评议']},
                    {name:'第六单元', areaList:['20、曹刿论战','21、邹忌讽齐王纳谏','22、出师表','23、词诗曲五首（十五 白雪 南乡 过零 山坡）','写作：有创意地表达','名著导读：《简.爱》','课外古诗词诵读（南安军 别云间 山坡羊 朝天子）']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},

            {name:'数学', cityList:[
                    {name:'第一单元', areaList:['市辖区','兴庆区','西夏区','金凤区','永宁县','贺兰县','灵武市']},
                    {name:'第二单元', areaList:['市辖区','大武口区','惠农区','平罗县']},
                    {name:'第三单元', areaList:['市辖区','利通区','盐池县','同心县','青铜峡市']},
                    {name:'第四单元', areaList:['市辖区','原州区','西吉县','隆德县','泾源县','彭阳县','海原县']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'英语', cityList:[
                    {name:'Unit1', areaList:['Asia']},
                    {name:'Unit2', areaList:['Great people']},
                    {name:'Unit3', areaList:['Robots']},
                    {name:'Unit4', areaList:['Life on Mars']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'物理', cityList:[
                    {name:'第十五章 电功和电热', areaList:['一、电能表与电功','二、电功率','三、电热器 电流的热效应','四、家庭电路与安全用电','综合实践活动']},
                    {name:'第十六章 电磁转换', areaList:['一、磁体与磁场','二、电流的磁场','三、磁场对电流的作用 电动机','四、安装直流电动机模型','五、电磁感应 发电机']},
                    {name:'第十七章 电磁波与现代通信', areaList:['一、信息与信息传播','二、电磁波及其传播','三、现代通信']},
                    {name:'第十八章 能有与可持续发展', areaList:['一、能源利用与社会发展','二、核能','三、太阳能','四、能量转化的基本规律','五、能源与可持续发展']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]},
            {name:'化学', cityList:[
                    {name:'第八单元 金属和金属材料', areaList:['课题1 金属材料','课题2 金属的化学性质','课题3 金属资源的利用和保护','实验活动4 金属的物理性质和某些化学性质']},
                    {name:'第九单元 溶液', areaList:['课题1 溶液的形成','课题2 溶解度','课题3 溶液的浓度','实验活动5 一定溶质质量分数的氯化钠溶液的配制']},
                    {name:'第十单元 酸和碱', areaList:['课题1 常见的酸和碱','课题2 酸和碱的中和反应','实验活动6 酸、碱的化学性质','实验活动7 溶液酸碱性的检验']},
                    {name:'第十一单元 盐 化肥', areaList:['课题1 生活中常见的盐','课题2 化学肥料','实验活动8 粗盐中难溶性杂质的去除']},
                    {name:'第十二单元 化学与生活', areaList:['课题1 人类重要的营养物质','课题2 化学元素与人体健康','课题3 有机合成材料']},
                    {name:'专题训练', areaList:[]},
                    {name:'综合测试', areaList:[]}
                ]}

        ]
    }

];