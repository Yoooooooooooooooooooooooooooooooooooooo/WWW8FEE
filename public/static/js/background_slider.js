var wallpapers;
var index_wallpaper;
var preload_url;
var preload_image = new Image();
var loaded_images = new Array();

var wallpaper1;
var wallpaper2;

function init_wallpaper_index()
{
	var index = Math.floor(Math.random() * wallpapers.length);
	if(index == wallpapers.length)
	{
		return 0;
	}
	return index;
}

function preload_wallpaper(){
	var index = Math.floor(Math.random() * wallpapers.length);
	if(index_wallpaper != index)
	{
		index_wallpaper = index;
	}
	else
	{
		preload_wallpaper();
		return;
	}
	preload_url = wallpapers[index];
	if($.inArray(preload_url, loaded_images) < 0)
	{
		preload_image.src=preload_url;
	}
}

function init_wallpaper()
{
	if(preload_image.complete || $.inArray(preload_url, loaded_images) >= 0)
	{
		$(wallpaper2).fadeOut("slow");
        setTimeout('$(wallpaper2).css("background-image", "url("+preload_url+")");',500);
        $(wallpaper2).fadeIn();
		$(wallpaper1).css("background-image", "url("+preload_url+")");
		setTimeout('preload_wallpaper();',500); 


		loaded_images.push(preload_url);
	}
}

/* 外部调用 图片url数组，背景控件class1，背景控件class2*/
function load_wallpapers(urls, cls_id1, cls_id2)
{
	wallpapers = urls;
	wallpaper1 = cls_id1;
	wallpaper2 = cls_id2;
	index_wallpaper = init_wallpaper_index();
	preload_url = wallpapers[index_wallpaper];
	init_wallpaper();
	setInterval("init_wallpaper()",10000);
}