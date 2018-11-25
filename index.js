window.onload = function () {

    function createLocation(functionName,address,x,y) {
        $.post("createTable.php",
            { functionname:functionName,arguments:[address,x,y] },
            function (data) {
                console.log(data);
            })
    }

    function createHardWare(functionName,solarPanel,azimuth,inclination,communication,inverter,sensor,genName) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [solarPanel,azimuth,inclination,communication,inverter,sensor,genName] },
            function (data) {
                // console.log(data);
            })
    }

    function createEfficiency(functionName,SystemPower,AnnualProduction,CO2,Reimbursement) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [SystemPower,AnnualProduction,CO2,Reimbursement] },
            function (data) {
                // console.log(data);
            })
    }

    function createGeneral(functionName,generalName,photo,operator,Comdate,Description,X,Y,name) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [generalName,photo,operator,Comdate,Description,X,Y,name] },
            function (data) {
                // console.log(data);
            })
    }

    $("#addDataJson").click(function (){
        $.getJSON('SunnyCYdata.json',function(data){
            $.each(data,function(i,field){
                createLocation("createLocation",field.Address,field.X,field.Y);
                createHardWare("createHardWare",field.SolarPanelmod,field.Azimuth,field.Inclination,field.Communication,field.Inverter,field.Sensor,field.name);
                createEfficiency("createEfficiency",field.SystemPower,field.AnnualProduction,field.CO2,field.Reimbursement,field.name);
                createGeneral("createGeneral",field.name,field.photo,field.operator,field.ComDate,field.Description,field.X,field.Y);
            });
        });
    });


}