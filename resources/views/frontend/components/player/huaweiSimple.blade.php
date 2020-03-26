<link rel="stylesheet" href="https://g.alicdn.com/de/prismplayer/2.8.1/skins/default/aliplayer-min.css" />
<video id="test" class="video-js vjs-default-skin vjs-big-play-centered">
</video>
<script src="https://media-cache.huaweicloud.com/video/hwplayer/1.0.0/lib/flv-1.4.2.min.js"></script>
<script src="https://media-cache.huaweicloud.com/video/hwplayer/1.0.0/dist/hwplayer.js?flvjs=true"></script>
{{--<script type="text/javascript" charset="utf-8" src="{{asset('/js/aliplayercomponents-1.0.3.min.js')}}"></script>--}}
<script>
    var flag = false;
    hwplayerloaded(function () {
        var options = {
            //是否显示控制栏，包括进度条，播放暂停按钮，音量调节等组件
            controls: true,
            width: "1200px",
            height: "675px",
            //是否开启播放质量数据上报功能
            stat:true,
            userId: 'playerDemo01',
            domainId: 'hwPlayer',
        };

        var player = new HWPlayer('test', options, function () {
            //播放器已经准备好了
            player.src("{!! $video['url'] !!}");
            // "this"指向的是HWPlayer的实例对象player
            player.play();
            // 使用事件监听
            player.on("firstplay",function () {

            })

            player.on('pause', function () {
                console.log(player.currentTime());
                if(!flag)
                {
                    $.post('{{\Illuminate\Support\Facades\URL::full()}}/record',{
                        progress:player.currentTime(),
                        videoLong:player.duration(),
                        _token:$('meta[name="csrf-token"]').attr('content')
                    },function (response) {
                        if(response.status ==0){flag=true;}
                    });
                }

            });
        });
    });
</script>