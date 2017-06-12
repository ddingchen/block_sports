<div class="weui-cells">
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>真实姓名</p>
        </div>
        <div class="weui-cell__ft">{{ $registion->realname }}</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>性别</p>
        </div>
        <div class="weui-cell__ft">{{ $registion->readableSex() }}</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>身份证号</p>
        </div>
        <div class="weui-cell__ft">{{ $registion->idcard_no }}</div>
    </div>
    <div class="weui-cell">
        <div class="weui-cell__bd">
            <p>联系电话</p>
        </div>
        <div class="weui-cell__ft">{{ $registion->tel }}</div>
    </div>
</div>
