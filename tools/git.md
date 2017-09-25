# git reset hard/soft/mixed区别

git reset 根据–soft –mixed –hard，会对working tree和index和HEAD进行重置:
> git reset --mixed：此为默认方式，不带任何参数的git reset，即时这种方式，它回退到某个版本，只保留源码，回退commit和index信息

> git reset --soft：回退到某个版本，只回退了commit的信息，不会恢复到index file一级。如果还要提交，直接commit即可

> git reset  --hard：彻底回退到某个版本，本地的源码也会变为上一个版本的内容，此命令 慎用！