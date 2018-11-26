window.onload = function () {
    var inputData = [];
    function createLocation(functionName,address,x,y,genName) {
        $.post("createTable.php",
            { functionname:functionName,arguments:[address,x,y,genName] },
            function (data) {
                //console.log(data);
                return data;
            })
    }

    function createHardWare(functionName,solarPanel,azimuth,inclination,communication,inverter,sensor,genName) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [solarPanel,azimuth,inclination,communication,inverter,sensor,genName] },
            function (data) {
                // console.log(data);
                return data;
            })
    }

    function createEfficiency(functionName,SystemPower,AnnualProduction,CO2,Reimbursement,genName) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [SystemPower,AnnualProduction,CO2,Reimbursement,genName] },
            function (data) {
                // console.log(data);
                return data;
            })
    }

    function createGeneral(functionName,generalName,photo,operator,Comdate,Description) {
        $.post("createTable.php",
            { functionname:functionName,arguments: [generalName,photo,operator,Comdate,Description] },
            function (data) {
                // console.log(data);
                return data;
            })
    }

    function deleteAllPV(functionName) {
        $.post("deleteTable.php",
            { functionname:functionName},
            function (data) {
                // console.log(data);
            })
    }

    function deleteOnePV(functionName,generalName,X,Y) {
        $.post("deleteTable.php",
            { functionname:functionName,arguments: [generalName,X,Y] },
            function (data) {
                // console.log(data);
            })
    }

    $("#addDataJson").click(function (){
        $.ajax({
            dataType: "json",
            url: 'SunnyCYdata.json',
            async: false,
            success: function(field){
                for (var i =0; i<field.length; i++){
                    $.when(createLocation("createLocation",field[i].Address,field[i].X,field[i].Y,field[i].name))
                        .then(function(data){
                            $.when(createHardWare("createHardWare",field[i].SolarPanelmod,field[i].Azimuth,field[i].Inclination,field[i].Communication,field[i].Inverter,field[i].Sensor,field[i].name))
                            .then(function(data){
                                $.when(createEfficiency("createEfficiency",field[i].SystemPower,field[i].AnnualProduction,field[i].CO2,field[i].Reimbursement,field[i].name))
                                .then(function(data){
                                    createGeneral("createGeneral",field[i].name,field[i].photo,field[i].operator,field[i].ComDate,field[i].Description);  
                                })
                            }) 
                        })
                }
            }
          });
        // $.getJSON('SunnyCYdata.json',function(data){
        //     $.each(data,function(i,field){
        //         // $.when(createLocation("createLocation",field.Address,field.X,field.Y,field.name))
        //         // .then(function(data){
        //         //     $.when(createHardWare("createHardWare",field.SolarPanelmod,field.Azimuth,field.Inclination,field.Communication,field.Inverter,field.Sensor,field.name))
        //         //     .then(function(data){
        //         //         $.when(createEfficiency("createEfficiency",field.SystemPower,field.AnnualProduction,field.CO2,field.Reimbursement,field.name))
        //         //         .then(function(data){
        //         //             createGeneral("createGeneral",field.name,field.photo,field.operator,field.ComDate,field.Description);  
        //         //         })
        //         //     }) 
        //         // })
        //         console.log("Location"+" "+field.name);
        //         createLocation("createLocation",field.Address,field.X,field.Y,field.name);
        //         console.log("HardWare"+" "+field.name);
        //         createHardWare("createHardWare",field.SolarPanelmod,field.Azimuth,field.Inclination,field.Communication,field.Inverter,field.Sensor,field.name);
        //         console.log("Efficiency"+" "+field.name);
        //         createEfficiency("createEfficiency",field.SystemPower,field.AnnualProduction,field.CO2,field.Reimbursement,field.name);
        //         console.log("General"+" "+field.name);
        //         createGeneral("createGeneral",field.name,field.photo,field.operator,field.ComDate,field.Description);
        //         console.log("General"+" "+field.name);
        //     });
        // });
    });


}