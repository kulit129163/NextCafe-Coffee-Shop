(self.webpackChunk_N_E=self.webpackChunk_N_E||[]).push([[178],{432:function(e,t,s){Promise.resolve().then(s.bind(s,725))},8030:function(e,t,s){"use strict";s.d(t,{Z:function(){return o}});var r=s(2265);/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let a=e=>e.replace(/([a-z0-9])([A-Z])/g,"$1-$2").toLowerCase(),l=function(){for(var e=arguments.length,t=Array(e),s=0;s<e;s++)t[s]=arguments[s];return t.filter((e,t,s)=>!!e&&s.indexOf(e)===t).join(" ")};/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */var c={xmlns:"http://www.w3.org/2000/svg",width:24,height:24,viewBox:"0 0 24 24",fill:"none",stroke:"currentColor",strokeWidth:2,strokeLinecap:"round",strokeLinejoin:"round"};/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let n=(0,r.forwardRef)((e,t)=>{let{color:s="currentColor",size:a=24,strokeWidth:n=2,absoluteStrokeWidth:o,className:i="",children:d,iconNode:f,...u}=e;return(0,r.createElement)("svg",{ref:t,...c,width:a,height:a,stroke:s,strokeWidth:o?24*Number(n)/Number(a):n,className:l("lucide",i),...u},[...f.map(e=>{let[t,s]=e;return(0,r.createElement)(t,s)}),...Array.isArray(d)?d:[d]])}),o=(e,t)=>{let s=(0,r.forwardRef)((s,c)=>{let{className:o,...i}=s;return(0,r.createElement)(n,{ref:c,iconNode:t,className:l("lucide-".concat(a(e)),o),...i})});return s.displayName="".concat(e),s}},4086:function(e,t,s){"use strict";s.d(t,{Z:function(){return r}});/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let r=(0,s(8030).Z)("Mail",[["rect",{width:"20",height:"16",x:"2",y:"4",rx:"2",key:"18n3k1"}],["path",{d:"m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7",key:"1ocrg3"}]])},9321:function(e,t,s){"use strict";s.d(t,{Z:function(){return r}});/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let r=(0,s(8030).Z)("MapPin",[["path",{d:"M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z",key:"2oe9fu"}],["circle",{cx:"12",cy:"10",r:"3",key:"ilqhr7"}]])},9061:function(e,t,s){"use strict";s.d(t,{Z:function(){return r}});/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let r=(0,s(8030).Z)("Save",[["path",{d:"M15.2 3a2 2 0 0 1 1.4.6l3.8 3.8a2 2 0 0 1 .6 1.4V19a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2z",key:"1c8476"}],["path",{d:"M17 21v-7a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v7",key:"1ydtos"}],["path",{d:"M7 3v4a1 1 0 0 0 1 1h7",key:"t51u73"}]])},2022:function(e,t,s){"use strict";s.d(t,{Z:function(){return r}});/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let r=(0,s(8030).Z)("User",[["path",{d:"M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2",key:"975kel"}],["circle",{cx:"12",cy:"7",r:"4",key:"17ys0d"}]])},725:function(e,t,s){"use strict";s.r(t),s.d(t,{default:function(){return d}});var r=s(7437),a=s(2265),l=s(2022);/**
 * @license lucide-react v0.378.0 - ISC
 *
 * This source code is licensed under the ISC license.
 * See the LICENSE file in the root directory of this source tree.
 */let c=(0,s(8030).Z)("Camera",[["path",{d:"M14.5 4h-5L7 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2h-3l-2.5-3z",key:"1tc9qg"}],["circle",{cx:"12",cy:"13",r:"3",key:"1vg3eu"}]]);var n=s(4086),o=s(9321),i=s(9061);function d(){let[e,t]=a.useState("NextCafe Member"),[s,d]=a.useState("hello@nextcafe.com");return a.useEffect(()=>{let e=localStorage.getItem("user_name"),s=localStorage.getItem("user_email");e&&t(e),s&&d(s)},[]),(0,r.jsxs)("div",{className:"max-w-4xl mx-auto py-12",children:[(0,r.jsx)("h1",{className:"text-4xl font-black text-coffee-950 mb-12",children:"My Profile"}),(0,r.jsxs)("div",{className:"grid grid-cols-1 md:grid-cols-3 gap-8",children:[(0,r.jsxs)("div",{className:"col-span-1 bg-white p-8 rounded-[2.5rem] border border-coffee-50 shadow-sm flex flex-col items-center",children:[(0,r.jsxs)("div",{className:"relative group",children:[(0,r.jsx)("div",{className:"w-32 h-32 bg-cream-50 rounded-full flex items-center justify-center overflow-hidden border-4 border-white shadow-xl",children:(0,r.jsx)(l.Z,{className:"h-16 w-16 text-coffee-200"})}),(0,r.jsx)("button",{className:"absolute bottom-0 right-0 bg-[#C69276] p-3 rounded-full text-white shadow-lg hover:scale-110 transition-all",children:(0,r.jsx)(c,{className:"h-4 w-4"})})]}),(0,r.jsx)("h2",{className:"mt-6 text-xl font-bold text-coffee-950 text-center",children:e}),(0,r.jsx)("p",{className:"text-coffee-400 font-medium text-sm",children:"Member since 2026"})]}),(0,r.jsx)("div",{className:"col-span-2 bg-white p-10 rounded-[2.5rem] border border-coffee-50 shadow-sm",children:(0,r.jsxs)("form",{className:"space-y-6",children:[(0,r.jsxs)("div",{className:"grid grid-cols-1 md:grid-cols-2 gap-6",children:[(0,r.jsxs)("div",{className:"space-y-2",children:[(0,r.jsx)("label",{className:"text-xs font-black text-coffee-300 uppercase tracking-widest px-1",children:"Full Name"}),(0,r.jsxs)("div",{className:"relative",children:[(0,r.jsx)(l.Z,{className:"absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-coffee-200"}),(0,r.jsx)("input",{type:"text",placeholder:e,className:"w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10"})]})]}),(0,r.jsxs)("div",{className:"space-y-2",children:[(0,r.jsx)("label",{className:"text-xs font-black text-coffee-300 uppercase tracking-widest px-1",children:"Email Address"}),(0,r.jsxs)("div",{className:"relative",children:[(0,r.jsx)(n.Z,{className:"absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-coffee-200"}),(0,r.jsx)("input",{type:"email",placeholder:s,className:"w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10"})]})]})]}),(0,r.jsxs)("div",{className:"space-y-2",children:[(0,r.jsx)("label",{className:"text-xs font-black text-coffee-300 uppercase tracking-widest px-1",children:"Shipping Address"}),(0,r.jsxs)("div",{className:"relative",children:[(0,r.jsx)(o.Z,{className:"absolute left-4 top-4 h-4 w-4 text-coffee-200"}),(0,r.jsx)("textarea",{rows:3,placeholder:"123 Coffee Lane, Barista City",className:"w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10"})]})]}),(0,r.jsxs)("button",{className:"bg-[#C69276] text-white px-10 py-4 rounded-2xl font-black flex items-center space-x-3 hover:scale-105 transition-all shadow-xl shadow-[#C69276]/20",children:[(0,r.jsx)(i.Z,{className:"h-5 w-5"}),(0,r.jsx)("span",{children:"Save Changes"})]})]})})]})]})}}},function(e){e.O(0,[971,23,744],function(){return e(e.s=432)}),_N_E=e.O()}]);