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

//#region CREATE DATABASE RECORDS FROM JSON
    var field = [];
    function callCreateLocation(i){
        $.when(createLocation("createLocation",field[i].Address,field[i].X,field[i].Y,field[i].name))
        .then(function(data){
            callCreateHardware(i);
        });
    }

    function callCreateHardware(i){
        $.when(createHardWare("createHardWare",field[i].SolarPanelmod,field[i].Azimuth,field[i].Inclination,field[i].Communication,field[i].Inverter,field[i].Sensor,field[i].name))
        .then(function(data){
            callCreateEfficiency(i);
        });
    }

    function callCreateEfficiency(i){
        $.when(createEfficiency("createEfficiency",field[i].SystemPower,field[i].AnnualProduction,field[i].CO2,field[i].Reimbursement,field[i].name))
        .then(function(data){
            callCreateGeneral(i);
        });
    }

    function callCreateGeneral(i){
        $.when(createGeneral("createGeneral",field[i].name,field[i].photo,field[i].operator,field[i].ComDate,field[i].Description))
        .then(function (data){
            return;
        });
    }

    $("#addDataJson").click(function (){
        $.ajax({
            dataType: "json",
            url: 'SunnyCYdata.json',
            async: false,
            success: function(data){
                field = data;
                for (var i =0; i<field.length; i++){
                    callCreateLocation(i);
                }
            }
        });
    });
//#endregion
        
    function updateDBGeneral(functionName,Name,operation,ComDate,Description,userID){
        console.log("empike");
        $.post("updateData.php",
        {functionname:functionName,arguments:[Name,operation,ComDate,Description,userID]},
        function(data){
            //console.log(data);
        })
    }

    function updateDBLocation(functionName,Address,Latitude,Longtitude,user){
        $.post("updateData.php",
        {functionname:functionName,arguments:[Address,Latitude,Longtitude,user]},
        function(data){
            //console.log(data);
        })
    }

    function updateDBEfficiency(functionName,System,Annual,CO2,Reimbursement,user){
        $.post("updateData.php",
        {functionname:functionName,arguments:[System,Annual,CO2,Reimbursement,user]},
        function(data){
            //console.log(data);
        })
    }

    function updateDBHardware(functionName,solarPanel,Azimuth,Inclination,Communication,Inverter,Sensors,user){
        $.post("updateData.php",
        {functionname:functionName,arguments:[solarPanel,Azimuth,Inclination,Communication,Inverter,Sensors,user]},
        function(data){
            //console.log(data);
        })
    }

    document.getElementById("UpdateDataBase").addEventListener("click", function(){
        var user=document.getElementById("idGen").value;
        var Name = document.getElementById("NameGen").value;
        var operation = document.getElementById("operationGen").value;
        var ComDate = document.getElementById("comDateGen").value;
        var Description = document.getElementById("descriptionHW").value;
        updateDBGeneral("updateGeneral",Name,operation,ComDate,Description,user);
        var Address = document.getElementById("AddressLoc").value;
        var Latitude = document.getElementById("LatitudeLoc").value;
        var Longtitude = document.getElementById("LongtitudeLoc").value;
        updateDBLocation("updateLocation",Address,Latitude,Longtitude,Name);
        var System = document.getElementById("systemPowerEff").value;
        var Annual = document.getElementById("annualProductionEff").value;
        var CO2 = document.getElementById("co2AvoidedEff").value;
        var Reimbursement = document.getElementById("reimbursementEff").value;
        updateDBEfficiency("updateEfficiency",System,Annual,CO2,Reimbursement,Name);
        var solarPanel = document.getElementById("solarPanelHW").value;
        var Azimuth = document.getElementById("azimuthHW").value;
        var Inclination = document.getElementById("inclinationHW").value;
        var Communication = document.getElementById("communicationHW").value;
        var Inverter = document.getElementById("inverterHW").value;
        var Sensors = document.getElementById("sensorsHW").value;
        updateDBHardware("updateHardware",solarPanel,Azimuth,Inclination,Communication,Inverter,Sensors,Name);
    })

}