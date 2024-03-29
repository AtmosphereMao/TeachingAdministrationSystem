<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css"/>
<div id="xiaoteng-player"></div>
<script src="https://g.alicdn.com/de/prismplayer/2.8.1/aliplayer-h5-min.js"></script>
<script type="text/javascript" charset="utf-8" src="{{asset('/js/aliplayercomponents-1.0.3.min.js')}}"></script>
<script>
    new Aliplayer({
        "id": "xiaoteng-player",
        "width": "1200px",
        "height": "675px",
        "autoplay": false,
        "isLive": false,
        "rePlay": false,
        "playsinline": true,
        "preload": false,
        "cover": "{{$gConfig['system']['player_thumb']}}",
        "autoPlayDelay": 2,
        "autoPlayDelayDisplayText": '正在加载中...',
        "loadDataTimeout": "",
        "controlBarVisibility": "hover",
        "useH5Prism": true,
        "vid": "{{$video['aliyun_video_id']}}",
        "playauth": "{{aliyun_play_auth($video)}}",
        "encryptType": 1,
        components: [{
            name: 'BulletScreenComponent',
            type: AliPlayerComponent.BulletScreenComponent,
            args: ['{{$user ? sprintf('会员%s', $user['email']) : config('app.name')}}', {
                fontSize: '16px',
                color: '#000000'
            }, 'random']
        }]
    }, function (player) {
    });
</script>