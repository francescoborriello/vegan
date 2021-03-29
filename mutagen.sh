#!/bin/bash
mutagen terminate --label-selector=my-docker
mutagen terminate --label-selector=my-docker-siteconf

mutagen create \
       --label=my-docker \
       --sync-mode=two-way-resolved \
       --default-file-mode=0644 \
       --default-directory-mode=0755 \
       --ignore=/.idea \
       --ignore=/.docker \
       --ignore=/.github \
       --ignore=/vendor \
       --ignore=*.sql \
       --ignore=*.gz \
       --ignore=*.zip \
       --ignore=*.bz2 \
       --ignore-vcs \
       --symlink-mode=posix-raw \
       ./code docker://$(docker-compose ps -q web|awk '{print $1}')/code

mutagen create \
       --label=my-docker-siteconf \
       --sync-mode=two-way-resolved \
       --default-file-mode=0644 \
       --default-directory-mode=0755 \
       --symlink-mode=posix-raw \
       ./site.conf docker://$(docker-compose ps -q web|awk '{print $1}')/etc/nginx/conf.d/site.conf
