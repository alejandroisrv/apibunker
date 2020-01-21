<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body style="background-color: {{ $config['body_bgcolor']}}">
    <div>
        <table width="600" align="center" cellpadding="20" cellspacing="0" bgcolor="{{$config['header_bgcolor']}}">
            <tr>
                <td><img src="{{ $config['logo'] }}" alt="" width="160"></td>
            </tr>
        </table>
        <table width="600" align="center" cellpadding="10" cellspacing="0" bgcolor="{{ $config['subtitle_bgcolor'] }}">
            <tr>
                <td><div style="font-family: sans-serif; font-size:16px; color: #ffffff">Comprometidos con tu desarrollo y éxito profesional</div></td>
            </tr>
        </table>
        <table width="600" align="center" cellpadding="20" cellspacing="0" bgcolor="#ffffff">
            <tr>
                <td>
                   <table width="100%" align="center" cellpadding="0" cellspacing="0" bgcolor="#ffffff">
                        <tr>
                            <td>
                                <p style="font-family: sans-serif; font-size:16px; font-weight: bold ">Activación de cuenta</p>
                                <p style="font-family: sans-serif; font-size:14px;"> <b> ¡Gracias por registrarte! </b>
                                    Cuando actives tu cuenta podrás disfrutar de nuestros servicios.</p>
                                    <br>
                                <div>
                                    <a href="{{ $config['activate'] }}" style="font-family: sans-serif; font-size:14px; background-color: #035175; padding: 8px 10px;color: #ffffff; text-decoration: none;">Activar cuenta</a></div> 
                                    <br>
                                </div>
                            </td>
                        </tr>

                    </table> 
                </td>
            </tr>
        </table>
        <table width="600" align="center" cellpadding="10" cellspacing="0" bgcolor="#fff" style="border-top: 1px solid #e8e8e8; border-bottom: 1px solid #e8e8e8;">
            <tr>
                <td>
                    <p style="font-family: sans-serif; font-size:14px;">
                        {{ $config['www'] }}
                    </p>
                </td>
                <td></td>
                <td></td>
                <td align="right">
                    <span style="font-family: sans-serif; font-size:14px;">Estamos en:</span>
                </td>
            </tr>
        </table>
        <table width="600" align="center" cellspacing="0" bgcolor="#fff">
            <tr>
            <td><p style="font-family: sans-serif; font-size:14px; padding: 6px; margin-bottom: 0px; margin-top: 20px;">{{ $config['revista_ip'] }}</p></td>
            </tr>
        </table>
        <table width="600" align="center" cellpadding="10" cellspacing="0" bgcolor="{{ $config['footer_bgcolor'] }}">
            <tr>
                <td>
                    <div style="font-family: sans-serif; font-size:14px; color: #fff; line-height: 20px"> 
                        &copy; {{ $config['copyright'] }}
                    </div>
                </td>
            </tr>
        </table>
        
    </div>
    
</body>
</html>