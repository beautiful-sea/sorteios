export default {

    getTablesInfos(extra_columns = true) {
        let tableInfos = [
            {table: 'vehicle_submodel_infos', name: "Versão"},
            {table: 'vehicle_engine_liter_infos', name: "Cilindrada"},
            {table: 'vehicle_engine_valve_infos', name: "Válvulas"},
            {table: 'vehicle_engine_version_infos', name: "Motor"},
            {table: 'vehicle_engine_cylinder_infos', name: "Cilindros"},
            {table: 'vehicle_engine_aspiration_infos', name: "Aspiração"},
            {table: 'vehicle_engine_power_infos', name: "Potência"},
            {table: 'vehicle_fuel_type_infos', name: "Tipo Combustível"},
            {table: 'vehicle_fuel_mfr_name_infos', name: "Sistema Combustível"},
            {table: 'vehicle_transmission_control_type_infos', name: "Transmissão"},
            {table: 'vehicle_transmission_mfr_name_infos', name: "Modelo Transmissão"},
            {table: 'vehicle_drive_type_infos', name: "Tração"},
            {table: 'vehicle_drive_type_mfr_name_infos', name: "Modelo Tração"},
            {table: 'vehicle_num_door_infos', name: "Número Portas"},
            {table: 'vehicle_body_type_infos', name: "Tipo Carroceria"},
            {table: 'vehicle_body_type_mfr_name_infos', name: "Nome Carroceria"},
            {table: 'vehicle_body_generation_infos', name: "Código Carroceria"},
            {table: 'vehicle_load_capacity_infos', name: "Capacidade Carga"},
            {table: 'vehicle_mfr_code_infos', name: "Código do Veículo"},
            // {table: 'vehicle_engine_valve_command_infos', name: "Comando Válvulas"},
            // {table: 'vehicle_fuel_delivery_name_infos', name: "Sistema Injeção"},
        ];
        if(extra_columns){
            tableInfos.push({table: 'quantity', name: "Quantidade"});
            tableInfos.push({table: 'note', name: "Anotação"});
            tableInfos.push({table: 'fitment_position', name: "Posição"});
        }
        return tableInfos;
    },

    getTableName(table = '') {
        return this.getTablesInfos().find(data => data.table == table)?.name || '';
    },


    toCacheList(){
        return [
            { url : 'admin/vehicles/types' , campo : 'types'},
            { url : 'admin/vehicles/types?perPage=99999' , campo : 'types_full'},
            { url : 'api/front/vehicles/types?perPage=99999' , campo : 'types_full2'},

            { url : 'admin/vehicles/models' , campo : 'models'},
            { url : 'admin/vehicles/models?perPage=99999' , campo : 'models_full'},
            { url : '/vehicles/models' , campo : 'models_full1'},
            { url : '/vehicles/models?perPage=99999' , campo : 'models_full2'},

            { url : 'admin/brands' , campo : 'brands'},
            { url : 'admin/brands?perPage=99999' , campo : 'brands_full'},
            { url : '/catalog/brands' , campo : 'brands_full1'},
            { url : '/catalog/brands?perPage=99999' , campo : 'brands_full2'},

            { url : 'admin/vehicles/years' , campo : 'years'},
            { url : 'admin/vehicles/years?perPage=99999' , campo : 'years_full'},
            { url : '/vehicles/years?perPage=99999' , campo : 'years_full1'},

            { url : 'admin/vehicles/vehicles' , campo : 'vehicles'},
            { url : 'admin/vehicles/vehicles?perPage=99999' , campo : 'vehicles_full'},
            { url : '/vehicles/vehicles?perPage=99999' , campo : 'vehicles_full2'},

            { url : 'admin/vehicles/makes' , campo : 'makes'},
            { url : 'admin/vehicles/makes?perPage=99999' , campo : 'makes_full'},
            { url : '/vehicles/makes?perPage=99999' , campo : 'makes_full2'},

            { url : '/vehicles/infos/fitment_positions?perPage=9999' , campo : 'fitment_positions'},

            { url : '/version_copier/getNewModels' , campo : 'getNewModels'},

            /*
             *INFOS
             */
            {url: '/admin/vehicles/infos/submodel?perPage=99999', campo: "submodel_full"},
            {url: '/admin/vehicles/infos/engine_liter?perPage=99999', campo: "engine_full"},
            {url: '/admin/vehicles/infos/engine_valve?perPage=99999', campo: "valve_full"},
            {url: '/admin/vehicles/infos/engine_version?perPage=99999', campo: "version_full"},
            {url: '/admin/vehicles/infos/engine_cylinder?perPage=99999', campo: "cylinder_full"},
            {url: '/admin/vehicles/infos/engine_aspiration?perPage=99999', campo: "aspiration_full"},
            {url: '/admin/vehicles/infos/engine_power?perPage=99999', campo: "power_full"},
            {url: '/admin/vehicles/infos/fuel_type?perPage=99999', campo: "fuel_type_full"},
            {url: '/admin/vehicles/infos/fuel_mfr_name?perPage=99999', campo: "fuel_mfr_name_full"},
            {url: '/admin/vehicles/infos/transmission_control_type?perPage=99999', campo: "transmission_control_full"},
            {url: '/admin/vehicles/infos/transmission_mfr_name?perPage=99999', campo: "transmission_mfr_name_full"},
            {url: '/admin/vehicles/infos/drive_type?perPage=99999', campo: "drive_type_full"},
            {url: '/admin/vehicles/infos/drive_type_mfr_name?perPage=99999', campo: "drive_type_mfr_name_full"},
            {url: '/admin/vehicles/infos/num_door?perPage=99999', campo: "num_door_full"},
            {url: '/admin/vehicles/infos/body_type?perPage=99999', campo: "body_type_full"},
            {url: '/admin/vehicles/infos/body_type_mfr_name?perPage=99999', campo: "body_type_mfr_name_full"},
            {url: '/admin/vehicles/infos/body_generation?perPage=99999', campo: "body_generation_full"},
            {url: '/admin/vehicles/infos/load_capacity?perPage=99999', campo: "load_capacity_full"},
            {url: '/admin/vehicles/infos/mfr_code?perPage=99999', campo: "mfr_code_full"},

        ];
    },

    /**
     * Obtem valores de cache a partir da url
     * @param {string} url - URL
     */
    getCacheByUrl(url = null){
        console.log(url);
        let dados = null;
        let campo = this.toCacheList().find(data => data.url == url)?.campo || null;

        if(campo){
            dados = this.getCache(campo);
        }

        return dados;
    },

    /**
     * Obtem valores de cache a partir da url
     * @param {string} url - URL
     * @param {any} valor - valor a ser associado pelo nome do cache.
     */
    setCacheByUrl(url, valor){

        let campo = this.toCacheList().find(data => data.url == url.trim())?.campo || null;

        if(campo){
            this.setCache(campo, valor);
        }
    },

    /**
     * @param {string} nomeCache - Nome da chave salva no local storage.
     * @param {any} valor - valor a ser associado pelo nome do cache.
     * @param {number} tempoVida- Tempo de vida em segundos.
     */
    setCache(nomeCache, valor, tempoVida = (60*10)){

        const data = {
            value: valor,                  // store the value within this object
            ttl: Date.now() + (tempoVida * 6000),   // store the TTL (time to live)
        }

        localStorage.setItem(nomeCache, JSON.stringify(data));
    },

    /**
     * @param {string} nomeCache - A key to identify the data.
     * @returns {any|null} returns the value associated with the key if its exists and is not expired. Returns `null` otherwise
     */
    getCache(nomeCache){
        const data = localStorage.getItem(nomeCache);

        //se n existe retorno null
        if (!data) {
            return null;
        }

        //transformando em json
        const item = JSON.parse(data);

        // se o tempo expirou eu removo esse campo e retorno null
        if (Date.now() > item.ttl) {
            localStorage.removeItem(nomeCache);
            return null;
        }

        // return data if not expired
        return item.value;
    },
};
