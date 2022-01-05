<?php

return [

    'sensors' => [
        [
            "type" => "thermo_hygrometer",
            "name" => "温湿度センサー",
            "description" => "温度・湿度の測定",
        ],
        [
            "type" => "CO2",
            "name" => "CO2センサー",
            "description" => "二酸化炭素濃度の計測",
        ],
        [
            "type" => "O2",
            "name" => "O2センサー",
            "description" => "酸素濃度の計測",
        ],
        [
            "type" => "water_temperature",
            "name" => "水温センサー",
            "description" => "水温の計測",
        ],
        [
            "type" => "water_gauge",
            "name" => "水位センサー",
            "description" => "水位の計測",
        ],
        [
            "type" => "pH",
            "name" => "pHセンサー",
            "description" => "pHの計測",
        ],
        [
            "type" => "illuminometer",
            "name" => "光センサー",
            "description" => "光の検知",
        ],
        [
            "type" => "soil_moisture",
            "name" => "土壌水分計",
            "description" => "地温の計測、一定体積内に含まれる水の計測、水溶性塩類の総量の計測",
        ],
    ],
    'sensor_details' => [
        'thermo_hygrometer' => [
            [
                "type" => "thermometer",
                "name" => "温度",
                "description" => "温度の測定",
                "precision" => 0.1,
                "precision_type" => "float",
                "unit" => "°C",
                "measuring_range_lower_limit" => -20,
                "measuring_range_upper_limit" => 80,
            ],
            [
                "type" => "humidity",
                "name" => "湿度",
                "description" => "湿度の測定",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "%",
                "measuring_range_lower_limit" => 0,
                "measuring_range_upper_limit" => 100,
            ],
        ],
        'CO2' => [
            [
                "type" => "CO2",
                "name" => "CO2",
                "description" => "二酸化炭素濃度の計測",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "ppm",
                "measuring_range_lower_limit" => 0,
                "measuring_range_upper_limit" => 9999,
            ],
        ],
        'O2' => [
            [
                "type" => "O2",
                "name" => "O2",
                "description" => "酸素濃度の計測",
                "precision" => 0.1,
                "precision_type" => "float",
                "unit" => "%",
                "measuring_range_lower_limit" => 10,
                "measuring_range_upper_limit" => 30,
            ],
        ],
        'water_temperature' => [
            [
                "type" => "water_temperature",
                "name" => "水温",
                "description" => "水温の計測",
                "precision" => 0.1,
                "precision_type" => "float",
                "unit" => "°C",
                "measuring_range_lower_limit" => null,
                "measuring_range_upper_limit" => null,
            ],
        ],
        'water_gauge' => [
            [
                "type" => "water_gauge",
                "name" => "水位",
                "description" => "水位の計測",
                "precision" => 0.1,
                "precision_type" => "float",
                "unit" => "%",
                "measuring_range_lower_limit" => 0,
                "measuring_range_upper_limit" => 100,
            ],
        ],
        'pH' => [
            [
                "type" => "pH",
                "name" => "pH",
                "description" => "pHの計測",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "段階",
                "measuring_range_lower_limit" => 0,
                "measuring_range_upper_limit" => 14,
            ],
        ],
        'illuminometer' => [
            [
                "type" => "illuminometer",
                "name" => "照度",
                "description" => "照度の検知",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "lux",
                "measuring_range_lower_limit" => null,
                "measuring_range_upper_limit" => null,
            ],
        ],
        'soil_moisture' => [
            [
                "type" => "earth_thermometer",
                "name" => "地温",
                "description" => "地温の計測",
                "precision" => 0.1,
                "precision_type" => "float",
                "unit" => "mS/cm",
                "measuring_range_lower_limit" => null,
                "measuring_range_upper_limit" => null,
            ],
            [
                "type" => "volume_water_content",
                "name" => "体積含水率",
                "description" => "一定体積内に含まれる水の計測",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "°C",
                "measuring_range_lower_limit" => null,
                "measuring_range_upper_limit" => null,
            ],
            [
                "type" => "EC",
                "name" => "EC(電気伝導度)",
                "description" => "水溶性塩類の総量の計測",
                "precision" => 1,
                "precision_type" => "int",
                "unit" => "pF",
                "measuring_range_lower_limit" => null,
                "measuring_range_upper_limit" => null,
            ],
        ],
    ],

    'devices' => [
        [
            "type" => "air_conditioner",
            "key" => "air_conditioner",
            "name" => "エアコン",
        ],
        [
            "type" => "switch",
            "key" => "illumination",
            "name" => "照明",
        ],
        [
            "type" => "switch",
            "key" => "pump",
            "name" => "ポンプ",
        ],
        [
            "type" => "switch",
            "key" => "Fan",
            "name" => "扇風機",
        ],
        [
            "type" => "switch",
            "key" => "ventilation_fan",
            "name" => "換気扇",
        ],
        [
            "type" => "switch",
            "key" => "humidifier",
            "name" => "加湿器",
        ],
        [
            "type" => "switch",
            "key" => "dehumidification",
            "name" => "除湿器",
        ],
        [
            "type" => "switch",
            "key" => "solenoid_valve",
            "name" => "電磁弁",
        ],
        [
            "type" => "switch",
            "key" => "raising_seedlings",
            "name" => "育苗ローラ",
        ],
    ],

    "air_conditioner_mode" => [
        "弱" => "弱",
        "中" => "中",
        "強" => "強",
        "AUTO" => "AUTO",
        "パワフル" => "パワフル",
    ],
];
