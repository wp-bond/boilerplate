import{c as p,a as l,t as i,F as f,b as u,o as m,d as g}from"./vendor-e8575544.js";const _="/app/themes/boilerplate/dist/assets/logo-03d6d6da.png",y=(o,n)=>{const r=o.__vccOpts||o;for(const[s,e]of n)r[s]=e;return r},h={name:"HelloWorld",props:{msg:String,default:""},data(){return{count:0}}},b=l("img",{alt:"Vue logo",src:_},null,-1),v=l("p",null,[u("Edit "),l("code",null,"components/HelloWorld.vue"),u(" to test hot module replacement.")],-1);function O(o,n,r,s,e,t){return m(),p(f,null,[l("h1",null,"Vue "+i(r.msg),1),b,l("button",{onClick:n[0]||(n[0]=c=>e.count++)}," count is: "+i(e.count),1),v],64)}const L=y(h,[["render",O]]),N=Object.freeze(Object.defineProperty({__proto__:null,default:L},Symbol.toStringTag,{value:"Module"}));(function(){const n=document.createElement("link").relList;if(n&&n.supports&&n.supports("modulepreload"))return;for(const e of document.querySelectorAll('link[rel="modulepreload"]'))s(e);new MutationObserver(e=>{for(const t of e)if(t.type==="childList")for(const c of t.addedNodes)c.tagName==="LINK"&&c.rel==="modulepreload"&&s(c)}).observe(document,{childList:!0,subtree:!0});function r(e){const t={};return e.integrity&&(t.integrity=e.integrity),e.referrerpolicy&&(t.referrerPolicy=e.referrerpolicy),e.crossorigin==="use-credentials"?t.credentials="include":e.crossorigin==="anonymous"?t.credentials="omit":t.credentials="same-origin",t}function s(e){if(e.ep)return;e.ep=!0;const t=r(e);fetch(e.href,t)}})();const a=Object.assign({"./components/HelloWorld.vue":N}),d={};for(const o in a){const n=o.split("/").pop().replace(/\.\w+$/,"");d[n]=a[o].default}for(const o of document.getElementsByClassName("vue-app"))g({components:d,template:o.innerHTML}).mount(o);