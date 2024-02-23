<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Mongodb\Facades\MongoDB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = new User;
        $user->title = "jaime";
        $user->body = "jaimegov@gmail.com";
        $user->password = Hash::make('password');
        $user->save();
    }


    Parse.Cloud.define("listBridge", async function(req, res) {
        try {
          // Crear una consulta para la clase Bridge
          var bridgeQuery = new Parse.Query("Bridge");
      
          // Ejecutar la consulta
          const bridges = await bridgeQuery.find();
      
          // Obtener los ReferencePoints asociados a cada Bridge con todos sus datos
          const bridgesWithReferencePoints = await Promise.all(
            bridges.map(async bridge => {
              const referencePointQuery = new Parse.Query("ReferencePoint");
              referencePointQuery.equalTo("bridge_id", bridge);
              const referencePoints = await referencePointQuery.find();
      
              // Fetch para obtener todos los datos de cada ReferencePoint
              await Parse.Object.fetchAllIfNeeded(referencePoints);
      
              bridge.set("referencePoints", referencePoints);
              return bridge;
            })
          );
      
          // Convertir los resultados a formato JSON y enviar la respuesta
          const bridgesJSON = bridgesWithReferencePoints.map(bridge => bridge.toJSON());
          return (bridgesJSON);
        } catch (error) {
          console.error("Error al realizar la consulta: " + error.message);
            return("Error al realizar la consulta: " + error.message);
        }
      });


      Parse.Cloud.define("listBridge", async function(req, res) {
        try {
            let bridgesArray = [];
          // Crear una consulta para la clase Bridge
          var bridgeQuery = new Parse.Query("Bridge");
      
          // Ejecutar la consulta
          bridgeQuery.find().then((brindges) => {
            brindges.forEach((bridge) => {
                const arrayPoints = [];
                var referencePointQuery = new Parse.Query("ReferencePoint");
                referencePointQuery.equalTo("bridge", bridge.id);
                referencePointQuery.find().then((point) => {
                    if (point.length > 0) {
                        console.log("pointsVVVV");
                        point.map(async point => {
                            let object = {
                                'name': point.get("name"),
                            };
                              arrayPoints.push(object);
                        });
                      } else {
                        console.log("ffffpointsVVVV");
                        let object = {
                          'name': null,
                        };
                        arrayPoints.push(object);
                      }
                });
                bridge.set("referencePoints", arrayPoints);
                let bridgeInsert = {
                    'name' : bridge.get("name"),
                    'points' : arrayPoints
                };
                bridgesArray.push(bridgeInsert);
              });
          });
      
          return (bridgesArray);
        } catch (error) {
          console.error("Error al realizar la consulta: " + error.message);
            return("Error al realizar la consulta: " + error.message);
        }
      });


      ///sirveeee 1
      Parse.Cloud.define("listBridge", async function(req, res) {
        try {
            let bridgesArray = [];
    
            // Crear una consulta para la clase Bridge
            var bridgeQuery = new Parse.Query("Bridge");
    
            // Ejecutar la consulta
            const bridges = await bridgeQuery.find();
    
            for (const bridge of bridges) {
                const arrayPoints = [];
                var referencePointQuery = new Parse.Query("ReferencePoint");
                referencePointQuery.equalTo("bridge", bridge.id);
    
                const points = await referencePointQuery.find();
    
                if (points.length > 0) {
                    points.forEach(point => {
                        let object = {
                            'objectId': point.id,
                            'name': point.get("name"),
                            'mode' : point.get("mode"),
                            'time_eta' : point.get("time_eta"),
                        };
                        arrayPoints.push(object);
                    });
                } else {
                    let object = {
                        'name': null,
                    };
                    arrayPoints.push(object);
                }
    
                bridge.set("referencePoints", arrayPoints);
    
                let bridgeInsert = {
                    'bridgeId': bridge.id,
                    'bridge': bridge.get("name"),
                    'points': arrayPoints
                };
    
                bridgesArray.push(bridgeInsert);
            }
    
            return bridgesArray;
        } catch (error) {
            console.error("Error al realizar la consulta: " + error.message);
            return ("Error al realizar la consulta: " + error.message);
        }
    });

//obtener los puntos por puente bridgeId
Parse.Cloud.define("pointsByBridgeId", async function (req, res) {
    try {
        console.log("paramsssssVVV");
        console.log(req.params.objectId);
        let bridgesArray = [];

        // Crear una consulta para la clase Bridge
        var bridgeQuery = new Parse.Query("Bridge");
        bridgeQuery.equalTo("objectId", req.params.objectId);
        const bridge = await bridgeQuery.first();

        if (bridge) {
            let arrayPoints = [];
            var referencePointQuery = new Parse.Query("ReferencePoint");
            referencePointQuery.equalTo("bridge", bridge.id);

            const points = await referencePointQuery.find();

            if (points.length > 0) {
                let arrayPedestrian = [];
                let arrayPassengerVehicles = [];
                points.forEach(point => {
                    if(point.get("mode") == "pedestrian"){
                        let object = {
                            'objectId': point.id,
                            'name': point.get("name"),
                            'mode': point.get("mode"),
                            'time_eta': point.get("time_eta"),
                        };
                        arrayPedestrian.push(object);
                    }else{
                        let object = {
                            'objectId': point.id,
                            'name': point.get("name"),
                            'mode': point.get("mode"),
                            'time_eta': point.get("time_eta"),
                        };
                        arrayPassengerVehicles.push(object);
                    }
                });
                arrayPoints.push(arrayPedestrian);
                arrayPoints.push(arrayPassengerVehicles);
            }

            bridge.set("referencePoints", arrayPoints);

            let bridgeInsert = {
                'bridge': bridge.get("name"),
                'bridgeId': bridge.id,
                'points': arrayPoints
            };

            bridgesArray.push(bridgeInsert);
            console.log('Usuario encontrado:', bridge);
        } else {
            // El usuario no fue encontrado
            console.log('Usuario no encontrado');
        }

        return bridgesArray;
    } catch (error) {
        console.error("Error al realizar la consulta: " + error.message);
        return ("Error al realizar la consulta: " + error.message);
    }
});



//obtener punto por objectId
Parse.Cloud.define("pointByObjectId", async function (req, res) {
    try {
        const referencePointQuery = new Parse.Query("ReferencePoint");
        referencePointQuery.equalTo("objectId", req.params.objectId);

        const point = await referencePointQuery.first();

        if (point) {
            // El punto con el objectId especificado fue encontrado
            return point;
        } else {
            // No se encontró ningún punto con el objectId especificado
            console.log('Punto no encontrado');
            return { error: 'Punto no encontrado' };
        }
    } catch (error) {
        console.error('Error al realizar la consulta:', error);
        return { error: 'Error al realizar la consulta: ' + error.message };
    }
});

//checkpoint
Parse.Cloud.define("checkPoint", async function (req, res) {
    try {
        const referencePointQuery = new Parse.Query("ReferencePoint");
        referencePointQuery.equalTo("objectId", req.params.objectId);

        const point = await referencePointQuery.first();

        if (point) {
            // El punto con el objectId especificado fue encontrado
            return point;
        } else {
            // No se encontró ningún punto con el objectId especificado
            console.log('Punto no encontrado');
            return { error: 'Punto no encontrado' };
        }
    } catch (error) {
        console.error('Error al realizar la consulta:', error);
        return { error: 'Error al realizar la consulta: ' + error.message };
    }
});


Parse.Cloud.afterSave("checkPoint", (request) => {
    const query = new Parse.Query("Post");
    query.get(request.object.get("post").id)
      .then(function(post) {
        post.increment("comments");
        return post.save();
      })
      .catch(function(error) {
        console.error("Got an error " + error.code + " : " + error.message);
      });
  });

  Parse.Cloud.afterSave("CheckPoint", async (request) => {
    const checkPoint = request.object;
    const pedestrianPointer = checkPoint.get("pedestrianCrossing");

    // Si el pointer no está vacío, obtenemos el objeto Pedestrian
    if (pedestrianPointer) {
        const pedestrian = await pedestrianPointer.fetch();
        const checkInValue = pedestrian.get("checkin");

        try {
            var referencePoint = Parse.Object.extend("ReferencePoint");
            const referencePointQuery = new Parse.Query(referencePoint);
            referencePointQuery.equalTo("checkIn", "pin_7");
            referencePointQuery.limit(10);
            let referencePointSearch = await referencePointQuery.find().then((results) => {
                const transformedResults = results.map((point) => {
                    pedestrian.set("timeGoogle", point.get("time_eta"));
                    await pedestrian.save();
                  });

            });
        } catch (error) {
            console.error("Error al realizar la consulta:", error);
        }

        console.log("¡Hola!");
        //   await pedestrian.save();
    }
}); 






Parse.Cloud.afterSave("CheckPoint", async (request) => {
    const checkPoint = request.object;
    const pedestrianPointer = checkPoint.get("pedestrianCrossing");

    // Si el pointer no está vacío, obtenemos el objeto Pedestrian
    if (pedestrianPointer) {
        const pedestrian = await pedestrianPointer.fetch();
        const checkInValue = pedestrian.get("checkin");

        try {
            // Obtenemos el objeto `referencePoint` relacionado con el valor `checkin`
            let result = serarchObjectJe(checkInValue);
            console.log(result);

        } catch (error) {
            console.error("Error al realizar la consulta:", error);
        }

        console.log("¡Hola!");
        //   await pedestrian.save();
    }
});



async function serarchObjectJe(checkIn){
    // Obtenemos el objeto `referencePoint` relacionado con el valor `checkin`
    console.error("checkIn: " + checkIn);
    var BWT = Parse.Object.extend("BWT");
    const bwtQuery = new Parse.Query(BWT);
    bwtQuery.equalTo("name", "Hidalgo/Pharr - Pharr");
    bwtQuery.first({
        success: function (bwt) {
          console.warning("contrado en serarchObjectJe: " + bwt.get("name"));
          return bwt.get("name");
        },
        error: function (obj, error) {
            console.warning("error contrado en serarchObjectJe: ");
        }
      });
}

Parse.Cloud.afterSave("CheckPoint", (request) => {
    const checkPoint = request.object;
    const pedestrianPointer = checkPoint.get("pedestrianCrossing");


    let result = serarchObjectJe("pin_7999");
            console.log(result);
  });
  


  Parse.Cloud.afterSave("CheckPoint", async (request) => {
    const checkPoint = request.object;
    const pedestrianPointer = checkPoint.get("pedestrianCrossing");
  
    if (pedestrianPointer) {
      try {
        const pedestrian = await pedestrianPointer.fetch();
        const checkInValue = pedestrian.get("checkin");
  
        var referencePoint = Parse.Object.extend("ReferencePoint");
        const referencePointQuery = new Parse.Query(referencePoint);
        referencePointQuery.equalTo("checkIn", checkInValue);
        referencePointQuery.limit(10);
  
        const referencePointSearch = await referencePointQuery.find();
        const transformedResults = referencePointSearch.map((point) => {
          pedestrian.set("timeGoogle", point.get("time_eta"));
          return pedestrian.save(); // Use return for concurrent saving
        });
  
        await Promise.all(transformedResults); // Wait for all saves to complete
  
        console.log("¡Hola!");
      } catch (error) {
        console.error("Error al realizar la consulta:", error);
      }
    }
  });


  Parse.Cloud.afterSave("CheckPoint", async (request) => {
    const checkPoint = request.object;
    const typeMode = checkPoint.get("isPedestrian");

    switch (typeMode) {
        case true:
            const pedestrianPointer = checkPoint.get("pedestrianCrossing");
            if (pedestrianPointer) {
              try {
                const pedestrian = await pedestrianPointer.fetch();
                const checkInValue = pedestrian.get("checkin");
          
                var referencePoint = Parse.Object.extend("ReferencePoint");
                const referencePointQuery = new Parse.Query(referencePoint);
                referencePointQuery.equalTo("checkIn", checkInValue);
                referencePointQuery.equalTo("pedestrian", pedestrian.id);
                referencePointQuery.limit(10);
          
                const referencePointSearch = await referencePointQuery.find();
                const transformedResults = referencePointSearch.map((point) => {
                  pedestrian.set("timeGoogle", point.get("time_eta"));
                  return pedestrian.save(); // Use return for concurrent saving
                });
          
                await Promise.all(transformedResults); // Wait for all saves to complete
              } catch (error) {
                console.error("Error al realizar la consulta:", error);
              }
            }
            break;
        default:
            const crossingPointer = checkPoint.get("crossing");
            if(crossingPointer){
                const crossing = await crossingPointer.fetch();
                const checkInValue = crossing.get("checkin");

                //searchPointer
                var referencePoint = Parse.Object.extend("ReferencePoint");
                const referencePointQuery = new Parse.Query(referencePoint);
                referencePointQuery.equalTo("checkIn", checkInValue);
                referencePointQuery.equalTo("mode", "crossing");
                referencePointQuery.equalTo("crossing", crossing.id);
                referencePointQuery.limit(10);
          
                const referencePointSearch = await referencePointQuery.find();
                const transformedResults = referencePointSearch.map((point) => {
                    crossing.set("timeGoogle", point.get("time_eta"));
                  return crossing.save(); // Use return for concurrent saving
                });
          
                await Promise.all(transformedResults); // Wait for all saves to complete
            }
            break;
    }
  });


  
  Parse.Cloud.afterSave("CheckPoint", async (request) => {
    const checkPoint = request.object;
    const isPedestrian = checkPoint.get("isPedestrian");

    const processCrossing = async (pointer, mode) => {
        if (pointer) {
            try {
                const crossing = await pointer.fetch();
                const checkInValue = crossing.get("checkin");

                const referencePoint = Parse.Object.extend("ReferencePoint");
                const referencePointQuery = new Parse.Query(referencePoint);
                referencePointQuery.equalTo("checkIn", checkInValue);
                referencePointQuery.equalTo("mode", mode);
                referencePointQuery.equalTo("modePointer", crossing.id);
                referencePointQuery.limit(1);

                const referencePointSearch = await referencePointQuery.find();
                //times of google
                
                const transformedResults = referencePointSearch.map((point) => {
                    crossing.set("timeGoogle", point.get("time_eta"));
                    return crossing.save();
                });

                await Promise.all(transformedResults);
            } catch (error) {
                console.error("Error processing crossing:", error);
            }
        }
    };

    switch (isPedestrian) {
        case true:
            await processCrossing(checkPoint.get("pedestrianCrossing"), "pedestrian");
            break;
        default:
            await processCrossing(checkPoint.get("crossing"), "crossing");
            break;
    }
});


//asdafssf
Parse.Cloud.define("getPointsWithTimeForGoogle", async (request) => {
    const query = new Parse.Query("ReferencePoint");
    query.equalTo("timeForGoogle", true);
  
    try {
      const results = await query.find({ useMasterKey: true });
      const jsonResults = results.map((result) => result.toJSON());
      return jsonResults;
    } catch (error) {
      throw new Error(`Error: ${error.code} ${error.message}`);
    }
  });

  //update time google
  Parse.Cloud.define("patchTimeGoogleForReference", async (request) => {
    const objectId = request.params.objectId;
    const newTimeGoogle = request.params.newTimeGoogle;
  
    // Verifica que se proporcionen los parámetros necesarios
    if (!objectId || !nuevoTimeGoogle) {
      return throw new Error("objectId y nuevoTimeGoogle son parámetros requeridos.");
    }
  
    // Crea una referencia a la clase ReferencePoint
    const ReferencePoint = Parse.Object.extend("ReferencePoint");
    
    try {
      // Consulta el registro en ReferencePoint con el objectId proporcionado
      const query = new Parse.Query(ReferencePoint);
      const reference = await query.get(objectId);
  
      // Actualiza el campo timeGoogle con el nuevo valor
      reference.set("timeGoogle", nuevoTimeGoogle);
  
      // Guarda los cambios en la base de datos
      await reference.save();
  
      // Retorna el objeto actualizado
      return reference.toJSON();
    } catch (error) {
      throw new Error(`Error al actualizar el registro: ${error.message}`);
    }
  });

}
