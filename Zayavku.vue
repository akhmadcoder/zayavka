<template>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Отправить заявку</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form @submit.prevent="createZayavka()" role="form">

                    <div class="col-md-10">
                      <!-- radio -->
                      <div class="form-group">
                        <label>Куда отправить заявку</label>
                        
                        <div class="form-check">
                          <input class="form-check-input" v-model="form.type" type="radio" name="type" :value="1">
                          <label class="form-check-label">текстовый файл</label>
                        </div>
                        <div class="form-check">
                          <input v-model="form.type" class="form-check-input" type="radio" name="type" :value="2">
                          <label class="form-check-label">база данных mysql</label>
                        </div>
                        <has-error :form="form" field="type"></has-error>
                      </div>

                    </div>


            <div class="col-md-10">
              <!-- text input -->
              <div class="form-group">
                <label>имя</label>
                    <input v-model="form.name" type="text" name="name" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('name') }">
                  <has-error :form="form" field="name"></has-error>
              </div>
            </div>

                    <div class="col-md-10">
                      <!-- text input -->
                      <div class="form-group">
                        <label>телефон</label>
                        <input v-model="form.phone" type="text" name="phone" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('phone') }">
                  <has-error :form="form" field="phone"></has-error>
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <label>Oбращение</label>
                        <textarea v-model="form.description" name="description" 
                    class="form-control" :class="{ 'is-invalid': form.errors.has('description') }" rows="3" ></textarea>
                    <has-error :form="form" field="description"></has-error>
                      </div>
                    </div>

                    <div class="col-md-10">
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary">Отправить</button>
                      </div>
                    </div>
                  
                </form>
              </div>
              <!-- /.card-body -->
            </div>
            
          </div>

        </div>
    </div>
</template>

<script>
    export default {

        data(){
            return{
                form: new Form({
                    id: '',
                    type: '',
                    name: '',
                    phone: '',
                    description: '',
                })

            }

        },

        methods:{

            createZayavka(){
            
                this.form.post('api/zayavka')
                .then(function(response){

                    if(response.data.status === 'success')
                    {
                      Reload.$emit('ReloadContent');
                      swal.fire(
                        'Created!',
                        'Ваши данные были успешно отправлены.',
                        'success'
                      )
                    }

                })
                .catch(()=>{

                    // if failed
                    swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: 'К сожалению, что-то не так!',
                    })
                })

            }

        },

        mounted() {

            Reload.$on('ReloadContent', () => {
                this.form.reset()
            });
        }
    }
</script>
