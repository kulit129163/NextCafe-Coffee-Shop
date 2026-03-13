"use client";
import React, { useEffect, useState } from 'react';
import { useParams, useRouter } from 'next/navigation';
import { motion, AnimatePresence } from 'framer-motion';
import { ArrowLeft, ShoppingCart, Star, Clock, ShieldCheck, Minus, Plus, Check, ChevronDown } from 'lucide-react';
import { useCart } from '@/lib/CartContext';
import Link from 'next/link';

const sizes = [
  { id: 'small', label: 'Small (12oz)', extra: 0 },
  { id: 'medium', label: 'Medium (16oz)', extra: 20 },
  { id: 'large', label: 'Large (22oz)', extra: 40 },
];

const drinkTypes = [
  { id: 'hot', label: '☕ Hot' },
  { id: 'iced', label: '🧊 Iced' },
  { id: 'blended', label: '🥤 Blended' },
];

const sugarLevels = [
  { id: '100', label: '100% (Full Sweet)' },
  { id: '75', label: '75% (Less Sweet)' },
  { id: '50', label: '50% (Half Sweet)' },
  { id: '25', label: '25% (Slightly Sweet)' },
  { id: '0', label: '0% (No Sugar)' },
];

const addOns = [
  { id: 'espresso-shot', label: 'Extra Espresso Shot', price: 30 },
  { id: 'whipped-cream', label: 'Whipped Cream', price: 20 },
  { id: 'caramel-drizzle', label: 'Caramel Drizzle', price: 15 },
  { id: 'vanilla-syrup', label: 'Vanilla Syrup', price: 15 },
  { id: 'oat-milk', label: 'Oat Milk Sub', price: 25 },
  { id: 'chocolate-drizzle', label: 'Chocolate Drizzle', price: 15 },
];

export default function ProductDetailPage() {
  const params = useParams();
  const router = useRouter();
  const { addToCart } = useCart();
  const [product, setProduct] = useState<any>(null);
  const [quantity, setQuantity] = useState(1);
  const [loading, setLoading] = useState(true);
  const [added, setAdded] = useState(false);

  // Customization states
  const [selectedSize, setSelectedSize] = useState('small');
  const [drinkType, setDrinkType] = useState('iced');
  const [sugarLevel, setSugarLevel] = useState('100');
  const [selectedAddOns, setSelectedAddOns] = useState<string[]>([]);

  const isBeverage = product && !['Pastries'].includes(product.category);

  useEffect(() => {
    const fetchProduct = async () => {
      try {
        const response = await fetch('/api/products');
        const data = await response.json();
        const found = data.find((p: any) => p.id.toString() === params.id);
        setProduct(found);
      } catch (error) {
        console.error('Error fetching product:', error);
      } finally {
        setLoading(false);
      }
    };
    fetchProduct();
  }, [params.id]);

  const sizeExtra = sizes.find(s => s.id === selectedSize)?.extra || 0;
  const addOnsTotal = selectedAddOns.reduce((sum, id) => {
    const addon = addOns.find(a => a.id === id);
    return sum + (addon?.price || 0);
  }, 0);
  const unitPrice = product ? Number(product.price) + sizeExtra + addOnsTotal : 0;

  const toggleAddOn = (id: string) => {
    setSelectedAddOns(prev =>
      prev.includes(id) ? prev.filter(a => a !== id) : [...prev, id]
    );
  };

  const handleAddToCart = () => {
    const sizeLabel = sizes.find(s => s.id === selectedSize)?.label || '';
    const typeLabel = drinkTypes.find(d => d.id === drinkType)?.label || '';

    const customization = isBeverage ? {
      size: selectedSize,
      drinkType,
      sugarLevel,
      addOns: selectedAddOns,
    } : undefined;

    addToCart({
      ...product,
      price: unitPrice,
      quantity,
      customization,
      customLabel: isBeverage
        ? `${sizeLabel} • ${typeLabel} • Sugar ${sugarLevel}%${selectedAddOns.length > 0 ? ' • +' + selectedAddOns.length + ' add-on(s)' : ''}`
        : undefined,
    });
    setAdded(true);
    setTimeout(() => setAdded(false), 2000);
  };

  if (loading) return (
    <div className="min-h-screen flex items-center justify-center bg-cream-50">
      <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-coffee-900"></div>
    </div>
  );

  if (!product) return (
    <div className="min-h-screen flex flex-col items-center justify-center bg-cream-50 text-coffee-950">
      <h2 className="text-3xl font-black mb-4">Product Not Found</h2>
      <Link href="/menu" className="flex items-center space-x-2 text-coffee-600 font-bold hover:underline">
        <ArrowLeft className="h-5 w-5" />
        <span>Back to Menu</span>
      </Link>
    </div>
  );

  return (
    <div className="max-w-6xl mx-auto py-12 px-6">
      {/* Back Button */}
      <button 
        onClick={() => router.back()}
        className="mb-12 flex items-center space-x-2 text-coffee-400 hover:text-coffee-950 transition-colors font-black uppercase text-xs tracking-widest"
      >
        <ArrowLeft className="h-4 w-4" />
        <span>Back to Collection</span>
      </button>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-16 items-start">
        {/* Left: Product Image */}
        <motion.div 
          initial={{ opacity: 0, x: -50 }}
          animate={{ opacity: 1, x: 0 }}
          className="relative group"
        >
          <div className="aspect-square rounded-[3.5rem] overflow-hidden shadow-2xl border-8 border-white">
            <img 
              src={product.image || '/images/default.png'} 
              alt={product.name} 
              className="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            />
          </div>
          <div className="absolute -bottom-8 -right-8 bg-[#2D1B14] p-8 rounded-full shadow-2xl border-4 border-white animate-bounce-slow">
             <Star className="text-[#D4A373] h-8 w-8 fill-[#D4A373]" />
          </div>
        </motion.div>

        {/* Right: Product Info */}
        <motion.div 
          initial={{ opacity: 0, x: 50 }}
          animate={{ opacity: 1, x: 0 }}
          className="flex flex-col h-full"
        >
          <div className="mb-4">
             <span className="bg-[#D4A373]/10 text-[#D4A373] px-4 py-2 rounded-full text-xs font-black uppercase tracking-widest">
               {product.category}
             </span>
          </div>

          <h1 className="text-5xl font-black text-coffee-950 mb-4 leading-tight">{product.name}</h1>
          
          <div className="flex items-center space-x-4 mb-6">
             <div className="flex text-yellow-400">
               {[...Array(5)].map((_, i) => <Star key={i} className="h-5 w-5 fill-current" />)}
             </div>
             <span className="text-coffee-300 font-bold text-sm">(124+ Reviews)</span>
          </div>

          <p className="text-lg text-coffee-500 font-medium leading-relaxed mb-8">
            {product.description || "Premium quality crafted with passion."}
          </p>

          {/* ☕ CUSTOMIZATION SECTION — Beverages Only */}
          {isBeverage && (
            <div className="bg-cream-50/50 border border-coffee-100 rounded-[2rem] p-6 mb-8 space-y-5">
              <h3 className="text-sm font-black uppercase tracking-widest text-coffee-950 flex items-center space-x-2">
                <span>☕</span><span>Customize Your Drink</span>
              </h3>

              {/* Drink Type Dropdown */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-coffee-400 ml-1">Drink Type</label>
                <div className="relative">
                  <select
                    value={drinkType}
                    onChange={(e) => setDrinkType(e.target.value)}
                    className="w-full appearance-none bg-white border-2 border-coffee-100 rounded-xl py-3.5 px-5 pr-12 outline-none focus:border-[#C69276] transition-all font-bold text-coffee-800 cursor-pointer"
                  >
                    {drinkTypes.map(d => (
                      <option key={d.id} value={d.id}>{d.label}</option>
                    ))}
                  </select>
                  <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-coffee-300 pointer-events-none" />
                </div>
              </div>

              {/* Size Dropdown */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-coffee-400 ml-1">Cup Size</label>
                <div className="relative">
                  <select
                    value={selectedSize}
                    onChange={(e) => setSelectedSize(e.target.value)}
                    className="w-full appearance-none bg-white border-2 border-coffee-100 rounded-xl py-3.5 px-5 pr-12 outline-none focus:border-[#C69276] transition-all font-bold text-coffee-800 cursor-pointer"
                  >
                    {sizes.map(s => (
                      <option key={s.id} value={s.id}>{s.label}{s.extra > 0 ? ` (+₱${s.extra})` : ''}</option>
                    ))}
                  </select>
                  <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-coffee-300 pointer-events-none" />
                </div>
              </div>

              {/* Sugar Level Dropdown */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-coffee-400 ml-1">Sugar Level</label>
                <div className="relative">
                  <select
                    value={sugarLevel}
                    onChange={(e) => setSugarLevel(e.target.value)}
                    className="w-full appearance-none bg-white border-2 border-coffee-100 rounded-xl py-3.5 px-5 pr-12 outline-none focus:border-[#C69276] transition-all font-bold text-coffee-800 cursor-pointer"
                  >
                    {sugarLevels.map(sl => (
                      <option key={sl.id} value={sl.id}>{sl.label}</option>
                    ))}
                  </select>
                  <ChevronDown className="absolute right-4 top-1/2 -translate-y-1/2 h-5 w-5 text-coffee-300 pointer-events-none" />
                </div>
              </div>

              {/* Add-ons Checkboxes */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-coffee-400 ml-1">Add-ons (Optional)</label>
                <div className="grid grid-cols-1 sm:grid-cols-2 gap-2">
                  {addOns.map(a => (
                    <button
                      key={a.id}
                      onClick={() => toggleAddOn(a.id)}
                      className={`flex items-center justify-between px-4 py-3 rounded-xl font-medium text-sm transition-all border-2 ${
                        selectedAddOns.includes(a.id)
                          ? 'border-[#C69276] bg-[#C69276]/10 text-[#C69276]'
                          : 'border-coffee-50 bg-white text-coffee-600 hover:border-coffee-200'
                      }`}
                    >
                      <span className="flex items-center space-x-2">
                        <span className={`w-4 h-4 rounded flex items-center justify-center text-white text-xs ${selectedAddOns.includes(a.id) ? 'bg-[#C69276]' : 'border-2 border-coffee-200'}`}>
                          {selectedAddOns.includes(a.id) && <Check className="h-3 w-3" />}
                        </span>
                        <span className="text-xs">{a.label}</span>
                      </span>
                      <span className="font-black text-coffee-400 text-xs">+₱{a.price}</span>
                    </button>
                  ))}
                </div>
              </div>
            </div>
          )}

          {/* Price */}
          <div className="text-4xl font-black text-[#C69276] mb-8">
            ₱{unitPrice.toFixed(2)}
            {(sizeExtra + addOnsTotal > 0) && (
              <span className="text-sm font-bold text-coffee-300 ml-3 line-through">₱{Number(product.price).toFixed(2)}</span>
            )}
          </div>

          {/* Quantity and Cart */}
          <div className="flex flex-col sm:flex-row items-center gap-6">
             <div className="flex items-center bg-cream-50 border border-coffee-100 rounded-[2rem] p-2 self-stretch sm:self-auto">
                <button 
                  onClick={() => setQuantity(Math.max(1, quantity - 1))}
                  className="p-4 hover:bg-white rounded-full transition-all text-coffee-950"
                >
                  <Minus className="h-6 w-6" />
                </button>
                <span className="w-16 text-center text-xl font-black text-coffee-950">{quantity}</span>
                <button 
                  onClick={() => setQuantity(quantity + 1)}
                  className="p-4 hover:bg-white rounded-full transition-all text-coffee-950"
                >
                  <Plus className="h-6 w-6" />
                </button>
             </div>

             <button 
               onClick={handleAddToCart}
               disabled={added}
               className={`flex-grow py-6 px-12 rounded-[2rem] font-black text-xl flex items-center justify-center space-x-4 transition-all shadow-2xl active:scale-95 group overflow-hidden relative ${
                 added ? 'bg-green-600 text-white' : 'bg-coffee-950 text-white hover:bg-[#D4A373]'
               }`}
             >
               <AnimatePresence mode="wait">
                 {added ? (
                   <motion.div key="check" initial={{ y: 20, opacity: 0 }} animate={{ y: 0, opacity: 1 }} exit={{ y: -20, opacity: 0 }} className="flex items-center space-x-4">
                     <Check className="h-6 w-6" /><span>Added to Order!</span>
                   </motion.div>
                 ) : (
                   <motion.div key="cart" initial={{ y: 20, opacity: 0 }} animate={{ y: 0, opacity: 1 }} exit={{ y: -20, opacity: 0 }} className="flex items-center space-x-4">
                     <ShoppingCart className="h-6 w-6 group-hover:rotate-12 transition-transform" /><span>Add to My Order</span>
                   </motion.div>
                 )}
               </AnimatePresence>
             </button>
          </div>

          {/* Proceed to Cart */}
          <Link 
            href="/cart"
            className="mt-6 w-full py-5 px-12 rounded-[2rem] font-black text-lg flex items-center justify-center space-x-4 bg-white border-2 border-[#C69276] text-[#C69276] hover:bg-[#C69276] hover:text-white transition-all shadow-lg hover:shadow-xl hover:shadow-[#C69276]/20 active:scale-95 group"
          >
            <ShoppingCart className="h-6 w-6 group-hover:animate-bounce" />
            <span>Proceed to Cart</span>
            <ArrowLeft className="h-5 w-5 rotate-180" />
          </Link>

          {/* Features */}
          <div className="grid grid-cols-3 gap-4 mt-12 border-t border-coffee-50 pt-10">
             <div className="flex flex-col items-center text-center space-y-2">
                <div className="bg-cream-50 p-3 rounded-xl"><Clock className="h-5 w-5 text-coffee-400" /></div>
                <span className="text-[10px] font-black uppercase text-coffee-300">Fast Brewing</span>
             </div>
             <div className="flex flex-col items-center text-center space-y-2">
                <div className="bg-cream-50 p-3 rounded-xl"><ShieldCheck className="h-5 w-5 text-coffee-400" /></div>
                <span className="text-[10px] font-black uppercase text-coffee-300">Premium Grade</span>
             </div>
             <div className="flex flex-col items-center text-center space-y-2">
                <div className="bg-cream-50 p-3 rounded-xl"><Star className="h-5 w-5 text-coffee-400" /></div>
                <span className="text-[10px] font-black uppercase text-coffee-300">Best Seller</span>
             </div>
          </div>
        </motion.div>
      </div>
    </div>
  );
}
