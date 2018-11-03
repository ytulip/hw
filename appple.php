<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" type="text/css" href="https://jqm.maimaiti.cn/js/calendar/mobile-select-date.css?version=2.10.11">
</head>
<body>
<p class="dbox"><input type="text" value="2015-08-17" readonly placeholder="有效期起始时间" id="idcard_date_begin" data-lcalendar="2016-05-11,2016-05-11" class="form-select-tb longtime"  compare-date="2004-01-01"><i></i></p>
</body>
<script src="https://jqm.maimaiti.cn/js/jquery.min.js"></script>
<script src="https://jqm.maimaiti.cn/js/calendar/dialog.js?version=1.7.7"></script>
<script src="mobile-select-date.js?version=<?php echo time();?>"></script>
<script>
    $(function()
    {
        var dateNow = new Date();
        var date_now = dateNow.getFullYear() + '-' + (dateNow.getMonth() + 1) + '-' + dateNow.getDate();
        var selectDate1 = new MobileSelectDate();
        selectDate1.init({trigger:'#idcard_date_begin',min:'2004-01-01',max:date_now,position:"bottom" ,ignore_long:true});
    });
</script>
</html>