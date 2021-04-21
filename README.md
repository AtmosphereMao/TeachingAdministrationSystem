# TeachingAdministrationSystem

教学管理系统。

## 进度

华为云鲲鹏大赛 - 赛题1。

### 未完成

* 学生学习行为统计


### 已完成

* 视频加密播放
* OBS存储视频与图片
* 流畅的视频访问体验
* 网络数据统计与分析
* 提供教学视频上传
* 在线点播
* 内容编目
* 标签
* 分类
* 属性设置
* 会员注册
* 购买

## 问题

### 未处理




### 已处理

* 标签改为课程选填项
* 通用页面的登录/注册修改为邮箱操作
* 手动支付，订单无法改为已支付
* 0元订单已支付，但无法订阅


## 运行方式
```shell
composer install --no-dev
cp .env.example .env
# 设置密钥
php artisan key:generate
php artisan jwt:secret
```

修改 `.env` 配置文件

```
# 创建上传目录软链接
php artisan storage:link
chmod -R  0777 storage
# 安装数据表
php artisan migrate
# 安装系统权限
php artisan install role
php artisan install administrator
php artisan install config
# 安装锁文件
php artisan install:lock
```