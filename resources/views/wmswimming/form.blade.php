<div class="weui-cells__title">
	参赛人员 @if($sex!='') （{{ $sex=='male'?'男':'女' }}） @endif
</div>
<div class="weui-cells">
	<div class="weui-cell">
	    <div class="weui-cell__hd"><label class="weui-label">真实姓名</label></div>
	    <div class="weui-cell__bd">
	    	<small></small>
	        <input class="weui-input" type="text" name="members[{{ $member }}][realname]" placeholder="请输入真实姓名">
	    </div>
	</div>

	<div class="weui-cell weui-cell_select weui-cell_select-after">
	    <div class="weui-cell__hd">
	        <label for="" class="weui-label">性别</label>
	    </div>
	    <div class="weui-cell__bd">
	    	<small></small>
	        <select class="weui-select" name="members[{{ $member }}][sex]">
	        	<option value="" @if($sex!='') disabled @endif>请选择性别</option>
	            <option value="male" @if($sex=='male') selected @endif @if($sex=='female') disabled @endif>男</option>
	            <option value="female" @if($sex=='female') selected @endif @if($sex=='male') disabled @endif>女</option>
	        </select>
	    </div>
	</div>

	<div class="weui-cell">
	    <div class="weui-cell__hd"><label class="weui-label">身份证号</label></div>
	    <div class="weui-cell__bd">
	    	<small></small>
	        <input class="weui-input" type="text" name="members[{{ $member }}][idcard_no]" placeholder="请输入二代身份证号码">
	    </div>
	</div>

	<div class="weui-cell">
	    <div class="weui-cell__hd"><label class="weui-label">联系电话</label></div>
	    <div class="weui-cell__bd">
	    	<small></small>
	        <input class="weui-input" type="number" name="members[{{ $member }}][tel]" pattern="[0-9]*" placeholder="请输入11位手机号码">
	    </div>
	</div>
</div>
