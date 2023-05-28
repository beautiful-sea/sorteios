export default {
    cadastrar(model, self, {url= null, toast = true, toastError = true,msg =false,loader = null},   callback = null, finalCallback = null){

        if(loader){
            self[loader] = true;
        }

        if(!model?.name && !msg){
            msg = 'Editar msg';
        }
        else{
            msg = msg || model.name + " foi cadastrado! ";
        }

        let data = new FormData();
        for(let i in model){
            if(model[i]) {
                data.append(i, model[i]);
            }
        }

        let apiUrl = self.baseUrl;
        if(url){
            apiUrl = url;
        }

        let config = {headers: { "Content-Type": "multipart/form-data" }}

        axios.post(apiUrl, data, config).then((response) => {

            let dadosCache = self.$helpers.getCacheByUrl(apiUrl);
            if(dadosCache && response?.data){
                dadosCache.data.data.push(response.data);
                self.$helpers.setCacheByUrl(apiUrl, dadosCache);
            }

            if(toast && !response.data.errors) {
                toastr.success(msg, 'Sucesso!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }

            if (typeof callback == "function"){
                callback({
                    error:!!response.data.errors,
                    ...response
                });
            }

        }).catch((error) => {
            console.log('Erro: ',error);
            if (typeof callback == "function"){
                callback({
                    error: true,
                    ...error.response
                });
            }
            if(toastError){
                Object.entries(error.response.data.errors).forEach((value) => {
                    toastr.error(value[1], 'Erro', {
                        closeButton: true,
                        tapToDismiss: false
                    });
                });
            }

        }).then((response) => {
            if (typeof finalCallback == "function"){
                finalCallback({...response});
            }
            if(loader){
                self[loader] = false;
            }
        })
    },
    atualizar(model, self,  {url= null, toast = true, msg =false, loader = false}, callback = null, finalCallback = null){

        Object.assign(model, {_method: 'PUT'});

        if(loader){
            self[loader] = true;
        }

        if(!model?.name && !msg){
            msg = 'Editar msg';
        }
        else{
            msg = msg || model.name + " foi editado! ";
        }

        let data = new FormData();
        for(let i in model){
            data.append(i, model[i]);
        }


        let apiUrl = self.baseUrl + '/';
        if(url){
            apiUrl = url;
        }

        let config = {headers: { "Content-Type": "multipart/form-data" }}

        axios.post(apiUrl + model.id, data, config).then((response) => {

            let url = apiUrl.substr(-1) == '/' ?  apiUrl.slice(0, -1) : apiUrl;
            self.$helpers.setCacheByUrl(url);

            if(toast ) {
                toastr.success(msg, 'Sucesso!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }

            if (typeof callback == "function"){
                callback({
                    error:false,
                    ...response
                });
            }

        }).catch((error) => {

            if (typeof callback == "function"){
                callback({
                    error: true,
                    ...error
                });
            }

            Object.entries(error.response.data.errors).forEach((value) => {
                toastr.error(value[1], 'Erro', {
                    closeButton: true,
                    tapToDismiss: false
                });
            });
        }).then((response) => {
            if (typeof finalCallback == "function"){
                finalCallback({...response});
            }
            if(loader){
                self[loader] = false;
            }
        })
    },
    listar(url, self, campoData = null,{loader= null, params = {}} = {}, callback = null, finalCallback = null){
        if(loader){
            self[loader] = true;
        }
        let apiUrl = self.baseUrl;
        if(url){
            apiUrl = url;
        }

        var dadosCache = {} ;

        // if(Object.keys(params).length == 0 || (Object.keys(params).length == 1  && Object.keys(params)[0] === 'perPage') ){
        //
        //     dadosCache = self.$helpers.getCacheByUrl(url);
        //     if(dadosCache){
        //
        //         if(campoData){
        //             self[campoData] = dadosCache.data;
        //         }
        //
        //         if (typeof callback == "function"){
        //             callback({
        //                 error: false,
        //                 ...dadosCache
        //             });
        //         }
        //
        //         if (typeof finalCallback == "function"){
        //             finalCallback({...dadosCache});
        //         }
        //
        //         if(loader){
        //             self[loader] = false;
        //         }
        //
        //         return;
        //     }
        // }

        axios.get(apiUrl, {params}).then((response) => {

            if(campoData){
                self[campoData] = response.data;
            }

            if(Object.keys(params).length == 0 || (Object.keys(params).length == 1  && Object.keys(params)[0] === 'perPage') ){
                self.$helpers.setCacheByUrl(url, response);
            }

            if (typeof callback == "function"){
                callback({
                    error: false,
                    ...response
                });
            }
        }).catch((error) => {
            if (typeof callback == "function"){
                callback({
                    error: true,
                    ...error,
                    message:error
                });
            }
        }).then((response) => {
            if (typeof finalCallback == "function"){
                finalCallback({...response});
            }
            if(loader){
                self[loader] = false;
            }
        });
    },
    deletar(id, self,  {url= null, toast = true, msg =false, loader = false} = {}, callback = null, finalCallback = null){

        msg = msg || "Removido com sucesso";

        if(loader){
            self[loader] = true;
        }

        let apiUrl = self.baseUrl + '/';
        if(url){
            apiUrl = url + '/';
        }

        axios.delete(apiUrl+id, {_method: 'DELETE'}).then((response) => {

            let url = apiUrl.substr(-1) == '/' ?  apiUrl.slice(0, -1) : apiUrl;
            self.$helpers.setCacheByUrl(url, null);

            if(toast ) {
                toastr.success(msg, 'Sucesso!', {
                    closeButton: true,
                    tapToDismiss: false
                });
            }

            if (typeof callback == "function"){
                callback({
                    error:false,
                    ...response
                });
            }

        }).catch((error) => {

            if (typeof callback == "function"){
                callback({
                    error: true,
                    ...error
                });
            }

            Object.entries(error.response.data.errors).forEach((value) => {
                toastr.error(value[1], 'Erro', {
                    closeButton: true,
                    tapToDismiss: false
                });
            });
        }).then((response) => {
            if (typeof finalCallback == "function"){
                finalCallback({...response});
            }
            if(loader){
                self[loader] = false;
            }
        })
    },

    download(url, self, campoData = null,{loader= null, params = {}} = {}, callback = null, finalCallback = null){
        if(loader){
            self[loader] = true;
        }
        let apiUrl = self.baseUrl;
        if(url){
            apiUrl = url;
        }

        axios({
            url: apiUrl, //your url
            method: 'GET',
            responseType: 'blob',
            params// important
        } ).then((response) => {

            const url = window.URL.createObjectURL(new Blob([response.data]));

            const link = document.createElement('a');
            link.href = url;
            link.setAttribute('download', `${self.nameFile}.xlsx`);
            document.body.appendChild(link);
            link.click();

            if(campoData){
                self[campoData] = response.data;
            }

            if (typeof callback == "function"){
                callback({
                    error: false,
                    ...response
                });
            }
        }).catch((error) => {
            if (typeof callback == "function"){
                callback({
                    error: true,
                    ...error
                });
            }
        }).then((response) => {
            if (typeof finalCallback == "function"){
                finalCallback({...response});
            }
            if(loader){
                self[loader] = false;
            }
        });
    },
};
