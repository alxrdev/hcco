<h1 align="center">
	HCCO - Holos Cadastro de Currículo Online
</h1>

<h3 align="center">
  Plugin WordPress para cadastro de currículo
</h3>

<p align="center">The best way to schedule your service!</p>

<p align="center">
  <img alt="GitHub top language" src="https://img.shields.io/github/languages/top/alxrdev/hcco?color=%23f58635">

  <a href="https://www.linkedin.com/in/alxrdev/" target="_blank" rel="noopener noreferrer">
    <img alt="Made by" src="https://img.shields.io/badge/made%20by-alex%20rodrigues%20moreira-%23f58635">
  </a>

  <img alt="Repository size" src="https://img.shields.io/github/repo-size/alxrdev/hcco?color=%23f58635">

  <a href="https://github.com/alxrdev/hcco/commits/master">
    <img alt="GitHub last commit" src="https://img.shields.io/github/last-commit/alxrdev/hcco?color=%23f58635">
  </a>

  <a href="https://github.com/alxrdev/hcco/issues">
    <img alt="Repository issues" src="https://img.shields.io/github/issues/alxrdev/hcco?color=%23f58635">
  </a>

  <img alt="GitHub" src="https://img.shields.io/github/license/alxrdev/hcco?color=%23f58635">
</p>

<p align="center">
  <a href="#%EF%B8%8F-sobre-o-projeto">Sobre o projeto</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-tecnologias">Tecnologias</a>&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;
  <a href="#-iniciando">Iniciando</a>
</p>
</br>

<p align="center">
  <img alt="Layout" src="https://i.imgur.com/JDkStev.gif">
</p>

## 💇🏻‍♂️ Sobre o projeto


Este é  um plugin **WordPress** que permite o cadastro e o pagamento de currículos online, utilizando as plataformas **PagSeguro** e **PicPay**.

## 🚀 Tecnologias

Tecnologias utilizadas para desenvolver este plugin

- [WordPress](https://wordpress.org/)
- [PHP](https://www.php.net/)

## 💻 Iniciando

### Requisitos

- Ter o WordPress instalado.
- PHP na versão 7.1 ou superior.

**Clone o repositório e mova para a pasta de plugins do seu WordPress**

```bash
$ git clone https://github.com/alxrdev/hcco.git
```

**Ative o plugin no painel WordPress**
- Plugins > Holos Cadastro de Currículo Online.

**Adicione o arquivo 'hcco.php' na pasta do seu tema WordPress**
```php
<?php
/**
* Template Name: Pagina de Cadastro de Curriculo
*
* @package hcco
* @since Holos 1.0
*/ 

if ( have_posts() ) :
    
    while ( have_posts() ) :
        
        the_post();
        // hcco page
        do_action('hcco_content');
        
    endwhile;
    
endif;
```

**Crie as seguintes páginas no painel WordPress e use como template da página, o template 'Pagina de Cadastro de Curriculo' criado anteriomente**
- Cadastro de Currículo
- Finalizar o Cadastro Do Currículo
- Cadastro do Currículo Finalizado

**Defina o preço do currículo**
- Curriculos > Configurações > Currículo

**Insira os tokens do PagSeguro**
- Curriculos > Configurações > PagSeguro

**Insira os tokens do PicPay**
- Curriculos > Configurações > PicPay

---

Feito com 💜 por Alex Rodrigues Moreira 👋 [Veja meu Linkedin](https://www.linkedin.com/in/alxrdev/)
