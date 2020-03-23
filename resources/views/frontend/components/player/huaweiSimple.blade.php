<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css" />
<div id="xiaoteng-player"></div>
<script src="https://media-cache.huaweicloud.com/video/hwplayer/1.0.0/lib/flv-1.4.2.min.js"></script>
<script src="https://media-cache.huaweicloud.com/video/hwplayer/1.0.0/dist/hwplayer.js?flvjs=true"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/js/aliplayercomponents-1.0.3.min.js')}}"></script>
<script>
    new Aliplayer({
        "id": "xiaoteng-player",
        "source": "{!! $video['url'] !!}",
        "width": "1200px",
        "height": "675px",
        "autoplay": false,
        "isLive": false,
        "rePlay": false,
        "playsinline": true,
        "cover": "{{$gConfig['system']['player_thumb']}}",
        "preload": false,
        "autoPlayDelay": 2,
        "autoPlayDelayDisplayText": '正在加载中...',
        "loadDataTimeout": "",
        "controlBarVisibility": "hover",
        "useH5Prism": true,
        components: [{
            name: 'BulletScreenComponent',
            type: AliPlayerComponent.BulletScreenComponent,
            args: ['{{$user ? sprintf('会员%s', $user['email']) : config('app.name')}}', {fontSize: '16px', color: '#000000'}, 'random']
        }]
    },function(player){
    });
    hwplayerloaded(function () {
        var options = {
            //是否显示控制栏，包括进度条，播放暂停按钮，音量调节等组件
            controls: true,
            width: 640,
            height: 360,
            //是否开启播放质量数据上报功能
            stat:true,
            userId: 'playerDemo01',
            domainId: 'hwPlayer',
        };
        var player = new HWPlayer('test', options, function () {
            //播放器已经准备好了
            player.src("https://35.cdn-vod.huaweicloud.com/asset/ba4f5df688f4ed6f569470d688ec4a22/c5d8003cb1d108035d3a902adb2bc5cc.mp4");
            // "this"指向的是HWPlayer的实例对象player
            player.play();
            // 使用事件监听
            player.on('ended', function () {
                //播放结束了
            });
        });
    });
</script>