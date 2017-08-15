<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" href="favicon.ico" /> 
    <base href="/tpl/">
    <link rel="stylesheet" href="css/index.css">
    <script src="js/vue.js"></script>
    <script src="js/index.js"></script>
    <title><?php echo (C("WEB_TITLE")); ?></title>
</head>

<body>
    <div id="app">
        <el-form ref="form" :model="form" label-width="80px">
            <el-form-item label="商家名称">
                <el-input v-model="form.name"></el-input>
            </el-form-item>
            <el-form-item label="商家区域">
                <el-select v-model="form.region" placeholder="请选择商家区域">
                    <el-option label="城西" value="shanghai"></el-option>
                    <el-option label="城北" value="n"></el-option>
                    <el-option label="城南" value="e"></el-option>
                    <el-option label="城东" value="w"></el-option>
                    <el-option label="花桥" value="beijing"></el-option>
                </el-select>
            </el-form-item>
            <el-form-item label="联系电话">
                <el-input type="text" v-model="form.phone"></el-input>
            </el-form-item>
            <el-form-item label="备注">
                <el-input type="textarea" v-model="form.desc"></el-input>
            </el-form-item>
            <el-form-item>
                <el-button type="primary" @click="onSubmit">提交</el-button>
                <el-button>取消</el-button>
            </el-form-item>
            
        </el-form>
    </div>
    <script>
        var Main = {
            data() {
                return {
                    form: {
                        name: '',
                        region: '',
                        phone:'',
                        desc: ''
                    }
                }
            },
            methods: {
                onSubmit() {
                    console.log(form);
                }
            }
        }
        var Ctor = Vue.extend(Main)
        new Ctor().$mount('#app')

    </script>
</body>

</html>