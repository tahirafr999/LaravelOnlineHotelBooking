
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Email Verification</div>
                <div class="card-body">
                   
                <p>Hi, This is {{ $MailData['company_name'] }}</p>
                <p>{{$MailData['randomId']}}</p>
                <p>It would be appriciative, if you gone through this feedback.</p>
                <p>Click the Below Link To Verify Your Account</p>
                <a href="http://127.0.0.1:8000/login/{{$MailData['randomId']}}">Click Me</a>
                </div>
            </div>
        </div>
    </div>
</div>

