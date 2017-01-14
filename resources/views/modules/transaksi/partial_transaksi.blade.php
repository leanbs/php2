<div class="text-center">
    <img class="img-thumbnail img-responsive" src="{{ $candidate->Photo }}" alt="candidate's photo" width="300">
</div>

<dl class="dl-horizontal">
    <dt><i class="fa fa-user"></i>&nbsp;No Nota</dt>
    <dd>{{ empty($candidate->age) ? '-' : $candidate->age }}</dd>

    <dt><i class="fa fa-transgender"></i>&nbsp;Gender</dt>
    <dd>{{ empty($candidate->gender) ? '-' : $candidate->gender }}</dd>

    <dt><i class="fa fa-heart"></i>&nbsp;Religion</dt>
    <dd>{{ empty($candidate->Religion) ? '-' : $candidate->Religion }}</dd>

    <dt><i class="fa fa-home"></i>&nbsp;Residence Type</dt>
    <dd>{{ empty($candidate->residence) ? '-' : $candidate->residence }}</dd>

    <dt><i class="fa fa-location-arrow"></i>&nbsp;Address</dt>
    <dd>{{ empty($candidate->Address) ? '-' : $candidate->Address }}</dd>

    <dt><i class="fa fa-envelope"></i>&nbsp;E-Mail</dt>
    <dd>
        <a href="mailto:{{ $email = $candidate->login()->select('Email')->first()->Email }}">
            {{ $email }}
        </a>
    </dd>

    <dt><i class="fa fa-phone"></i>&nbsp;Telephone / Mobile</dt>
    <dd>{{ empty($candidate->FixedPhone) ? '-' : $candidate->FixedPhone }} / {{ $candidate->MobilePhone }}</dd>

    <dt><i class="fa fa-heart-o"></i>&nbsp;Hobby</dt>
    <dd>{!! empty($candidate->Hobby) ? '-' : nl2br(e($candidate->Hobby)) !!}</dd>

    <dt><i class="fa fa-plus"></i>&nbsp;Strength</dt>
    <dd>{!! empty($candidate->Strength) ? '-' : nl2br(e($candidate->Strength)) !!}</dd>

    <dt><i class="fa fa-minus"></i>&nbsp;Weakness</dt>
    <dd>{!! empty($candidate->Weakness) ? '-' : nl2br(e($candidate->Weakness)) !!}</dd>

    <dt><i class="fa fa-file"></i>&nbsp;File</dt>
    <dd>
        <div>
            <a target="_blank" href="{{ url('/download/' . App\CandidateFile::RESUME . '/' . $candidate->LoginId) }}">
                CV / Resume
            </a>
        </div>

        <div>
            <a target="_blank" href="{{ url('/download/' . App\CandidateFile::ACADEMIC_TRANSCRIPT . '/' . $candidate->LoginId) }}">
                Transkrip Nilai
            </a>
        </div>
    </dd>
</dl><!-- /.dl-horizontal -->
