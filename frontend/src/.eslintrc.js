module.exports = {
    root: true,
    env: {
        node: true
    },
    'extends': [
        'plugin:vue/essential',
        'eslint:recommended'
    ],
    parserOptions: {
        parser: 'babel-eslint'
    },
    rules: {
        "no-useless-escape": 2,
        "no-unused-vars": 2,
        "vue/no-unused-components": 2
    }
}
