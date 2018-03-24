# config使用

## [主要功能]

放置預設參數，由DB控制，則不需要在每個 php 內宣告變數

## [用運]

```
select * from config;
```
configid 唯一碼，流水號
configkey 參數名稱，盡量不要一樣
configvalue 預設數值
remark 備註

## [目前已用]

| configid | configkey      | remark                                |
| -------- | -------------- | ------------------------------------- |
| 1        | admin_group    | admin 菜單權限，內容為菜單id，比照 table: usermenu |
| 2        | finance_group  | 財務 菜單權限，內容為菜單id，比照 table: usermenu    |
| 3        | employee_group | 員工 菜單權限，內容為菜單id，比照 table: usermenu    |

