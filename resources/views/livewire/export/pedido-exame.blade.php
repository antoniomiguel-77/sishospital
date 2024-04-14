<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pedido de Exame</title>
    <link href="{{asset('assets/css/bootstrap.min.css')}}" >
 
 
 
</head>
<body>
 
    {{-- Logotipo do Hospital --}}
    <div>
        <img style="width: 4rem;height: 4rem;margin-left: 45%" src="insignia.jpeg" alt="Insignia da República">
    </div>
    {{-- Cabecalho do relatório --}}
    <div style="text-align: center">
        <span style="text-transform: uppercase;font-size:12px">República de angola</span><br>
        <span style="text-transform: uppercase;font-size:12px">Ministério da Saúde</span><br>
        <span style="text-transform: uppercase;font-size:12px">Hospital Provincial</span><br>
    </div>
    <div style="text-align: center">
        <p style="text-transform: uppercase; text-decoration: underline;font-weight: bold;">Laboratório</p>
    </div>
 
    {{-- Corpo do Relatório --}}
    <div style="width: 100%; ">
        <div style="width: 90%; float:left; " >
            <span style="font-size: 12px;">Nome Completo: <span style="text-decoration: underline;" >Sujeito programador </span> </span>
        </div>
        <div style="width: 10%;float: right;">
            <span style="font-size: 12px">HC Nº: <span style="text-decoration: underline;">2024</span></span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
        <div style="width: 20%; float:left; " >
            <span style="font-size: 12px;">Genero: <span style="text-decoration: underline;" >Masculino </span> </span>
        </div>
        <div style="width: 20%;float: left;">
            <span style="font-size: 12px">Idade: <span style="text-decoration: underline;">26</span></span>
        </div>
        <div style="width: 60%;float: left;">
            <span style="font-size: 12px">Situação do Paciente: <span style="text-decoration: underline;">Situação critica</span></span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
        <div style="width: 20%; float:left; " >
            <span style="font-size: 12px;">Data: <span style="text-decoration: underline;" >{{date('d-m-Y')}} </span> </span>
        </div>
        <div style="width: 20%;float: left;">
            <span style="font-size: 12px">Serviço: <span style="text-decoration: underline;">{{date('d-m-Y')}}</span></span>
        </div>
        <div style="width: 60%;float: left;">
            <span style="font-size: 12px">Cama Nº: <span style="text-decoration: underline;">123</span></span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
      
        <div style="width: 100%;float: left; margin-top:1rem">
            <span style="font-size: 12px; font-weight:bold">Diagnostico Provavél: <span>{{str_repeat('_',90)}}</span></span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
      
        <div style="width: 100%;float: left; margin-top:1rem">
            <span style="font-size: 12px; font-weight:bold">Dados Clinícos: <span style="font-weight: normal">
                <i>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, voluptatum quibusdam velit blanditiis nisi expedita molestias veritatis asperiores libero dolor dolorum itaque quidem quisquam laboriosam recusandae quasi exercitationem enim repellat?    
                    
                </i>
            </span>
        </span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
        <div style="width: 100%;float: left; margin-top:1rem">
        <span style="font-size: 12px; font-weight:bold">Médico: <span style="font-weight: normal;text-decoration: underline">Sujeito Médico
            </span>
        </span>
        </div>
    </div>
    <div style="width: 100%; clear: both;">
        <table border="1" style="border-collapse: collapse; text-align-center">
            <thead>
                <tr>
                    <th style="font-size: 12px;font-weight: normal;">Nº</th>
                    <th style="font-size: 12px;font-weight: normal;">Data do Pedido</th>
                    <th style="font-size: 12px;font-weight: normal;">Hora</th>
                    <th style="font-size: 12px;font-weight: normal;">Exames</th>
                    <th style="font-size: 12px;font-weight: normal;">Descrição</th>
                </tr>
            </thead>
            <tbody>
                @for ($i=0;$i<20;$i++)
                <tr>
                    <td style="width: 10%; font-size:10px">111</td>
                    <td style="width: 15%; font-size:10px">{{date('d-m-Y')}}</td>
                    <td style="width: 10%; font-size:10px">{{date('H:i')}}</td>
                    <td style="width:20%; font-size:10px">
                        <ul style="list-style: none; text-align: start">
                            <li style="font-size:10px">1</li>
                            <li style="font-size:10px">2</li>
                            <li style="font-size:10px">3</li>
                        </ul>
                    </td>
                    <td style="width: 60%; font-size:10px">
                        <i>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Asperiores excepturi vel corporis recusandae adipisci consequuntur facere atque non obcaecati iste perferendis, modi debitis officia facilis dolorem sapiente repellat architecto alias.
                        </i>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </div>

 
     
        <p style="font-size: 10px;margin-top: 2rem">Processado por computador {{date('d-m-Y')}}</p>
 
 
      
 
</body>
</html>