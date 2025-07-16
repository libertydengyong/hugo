---
title: 'Alpine 开启bbr'
date: '2025-07-12T15:17:31+00:00'
author: ziyouhua
    - '8'
    - 'a:5:{s:8:"keywords";s:5:"74.51";s:9:"wordCount";s:1:"0";s:9:"linkCount";s:1:"0";s:12:"headingCount";s:1:"0";s:10:"mediaCount";s:1:"0";}'
    - '1'
    - '18'
categories:
    - vps技巧
tags:
    - 'Alpine 开启bbr'
---

Alpine 开启bbr: echo "tcp\_bbr" &gt;&gt; /etc/modules &amp;&amp; modprobe tcp\_bbr echo "net.ipv4.tcp\_congestion\_control=bbr" &gt;&gt; /etc/sysctl.conf echo "net.core.default\_qdisc=fq" &gt;&gt; /etc/sysctl.conf sysctl -p 验证 lsmod | grep bbr