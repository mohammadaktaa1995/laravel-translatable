<table class="table table-hover table-striped">
    <thead>
    <tr>
        
        <th style="">#</th>
        @foreach($translates[0]->getAllAttributes() as $key=>$translate)
            @if($key=='id')
                @continue
            @else
                <th style="{{is_arabic(translate($key,Translatable::getCurrentLocale()))?'direction:rtl;text-align:end':''}}">{{translate($key,Translatable::getCurrentLocale())}}</th>
            @endif
        @endforeach
        <th style="{{is_arabic(translate('update',Translatable::getCurrentLocale(),'Update'))?'direction:rtl;text-align:end':''}}">{{translate('update',Translatable::getCurrentLocale(),'Update')}}</th>
        <th style="{{is_arabic(translate('delete',Translatable::getCurrentLocale(),'delete'))?'direction:rtl;text-align:end':''}}">{{translate('delete',Translatable::getCurrentLocale(),'delete')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($translates as $key=>$translate)
        <tr>
            <td>{{++$key}}</td>
            @foreach($translate->getAllAttributes() as $val=>$item)
                @if($val=='id')
                    @continue
                @else
                    <td style="{{is_arabic($item)?'direction:rtl;text-align:end':''}}">{{$item}}</td>
                @endif
            @endforeach
            <td style="margin: 0 15px;"><a
                        style="cursor: pointer;margin: 0 15px;{{$dir=='rtl'?'float:left':''}}"
                        class="btn-update nc-icon nc-settings-tool-66"
                        data-key="{{$translate->id}}"></a></td>
            <td style="margin: 0 15px; "><a
                        style="cursor: pointer;{{$dir=='rtl'?'float:left':''}}"
                        class="btn-delete nc-icon nc-scissors"
                        data-key="{{$translate->id}}"></a></td>
        </tr>
    @endforeach
    </tbody>
</table>