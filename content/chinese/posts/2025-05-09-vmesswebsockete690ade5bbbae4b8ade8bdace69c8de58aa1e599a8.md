---
title: Vmess+WebSocket搭建中转服务器
date: '2025-05-09T06:13:18+00:00'
author: ziyouhua
    - '1'
categories:
    - vps工具
tags:
    - Vmess+WebSocket搭建中转服务器
---

文章来源: https://www.laoliuceping.com/31450.html 比如一台德国机慢，一台日本机快，给<span data-keep-original-tag="false" data-original-attrs="{"style":""}" style="color: #555555; font-family: 'Microsoft Yahei';">两台服务器都安装3x-ui面板，配置德鸡，</span><span data-keep-original-tag="false" data-original-attrs="{"style":""}" style="color: #555555; font-family: 'Microsoft Yahei';">面板进入“新建入站”界面。</span>

1. 选择协议为<span data-keep-original-tag="false" data-original-attrs="{"style":""}">Vmess</span>，默认端口为<span data-keep-original-tag="false" data-original-attrs="{"style":""}">10391</span>。
2. 添加用户时选择传输协议为WebSocket，并输入6-8位随机路径字符（如：`/abc123`）。
3. 确认后保存设置，将生成的链接导入到V2RAY客户端测试。若速度显示为数字，则表示配置成功。
 
<div data-original-attrs="{"style":""}">#### 配置日本中转机入站规则

1. 登录中转机的3x-ui面板，进入“新建入站”界面。
2. 协议选择为<span data-keep-original-tag="false" data-original-attrs="{"style":""}">dokodemo-door</span>（中文名“任意门”），默认端口为<span data-keep-original-tag="false" data-original-attrs="{"style":""}">35466</span>。
3. 设置目标地址和端口：目标地址填写德国落地机的IP（如：95.169.x.x），目标端口为10391。
4. 保存设置，完成配置。
 
<div>#### 修改V2RAY客户端设置

1. 编辑落地机的服务器配置，名称可随意设置。
2. 地址修改为中转机的IP（如：5.34.x.x），端口修改为中转机的端口35466。
3. 确认后右键测速，若显示速度数据则说明配置正常。
 
 </div></div>