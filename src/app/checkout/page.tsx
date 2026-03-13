"use client";
import React, { useState, useEffect } from 'react';
import { useCart } from '@/lib/CartContext';
import { motion } from 'framer-motion';
import { MapPin, Phone, User, ArrowLeft, ShoppingBag, CheckCircle2, Navigation, Truck } from 'lucide-react';
import { useRouter } from 'next/navigation';
import Link from 'next/link';

// Lalamove-style distance-based fee
const shippingRates = [
  { maxKm: 2, fee: 39, label: '0-2 km' },
  { maxKm: 5, fee: 59, label: '2-5 km' },
  { maxKm: 10, fee: 89, label: '5-10 km' },
  { maxKm: 20, fee: 129, label: '10-20 km' },
  { maxKm: 999, fee: 179, label: '20+ km' },
];

// Common FEU Tech area locations
const presetLocations = [
  { name: 'FEU Tech (P. Paredes)', distance: 0.5 },
  { name: 'UST Area', distance: 1.2 },
  { name: 'España Blvd', distance: 1.5 },
  { name: 'Quiapo / Recto', distance: 2.5 },
  { name: 'Cubao, QC', distance: 7 },
  { name: 'Makati CBD', distance: 10 },
  { name: 'BGC, Taguig', distance: 13 },
  { name: 'Las Piñas / Muntinlupa', distance: 22 },
  { name: 'Other Location', distance: -1 },
];

export default function CheckoutPage() {
  const { cart, subtotal, clearCart } = useCart();
  const router = useRouter();
  const [loading, setLoading] = useState(false);
  const [complete, setComplete] = useState(false);

  // Form states
  const [formData, setFormData] = useState({
    name: '',
    phone: '',
    address: '',
    gcashRef: '',
  });

  // Shipping states
  const [selectedLocation, setSelectedLocation] = useState('');
  const [customDistance, setCustomDistance] = useState('');
  const [shippingFee, setShippingFee] = useState(0);

  useEffect(() => {
    const storedName = localStorage.getItem('user_name');
    if (storedName) {
      setFormData(prev => ({ ...prev, name: storedName }));
    }
  }, []);

  // Calculate shipping fee based on distance
  useEffect(() => {
    const loc = presetLocations.find(l => l.name === selectedLocation);
    if (!loc) return;

    let distance = loc.distance;
    if (distance === -1 && customDistance) {
      distance = parseFloat(customDistance);
    }
    if (distance < 0 || isNaN(distance)) {
      setShippingFee(0);
      return;
    }

    const rate = shippingRates.find(r => distance <= r.maxKm);
    setShippingFee(rate?.fee || 179);
  }, [selectedLocation, customDistance]);

  const handleInputChange = (e: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    const { name, value } = e.target;
    setFormData(prev => ({ ...prev, [name]: value }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (cart.length === 0 || !formData.gcashRef) return;

    setLoading(true);

    try {
      const response = await fetch('/api/orders', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
          ...formData,
          paymentMethod: 'gcash',
          items: cart,
          shippingFee,
          total: subtotal + shippingFee,
        }),
      });

      if (response.ok) {
        setComplete(true);
        clearCart();
      } else {
        alert('Failed to place order. Please try again.');
      }
    } catch (err) {
      console.error(err);
      alert('An error occurred.');
    } finally {
      setLoading(false);
    }
  };

  if (complete) {
    return (
      <div className="min-h-[80vh] flex items-center justify-center p-4">
        <motion.div 
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          className="bg-white rounded-[3rem] p-12 md:p-20 shadow-2xl border border-coffee-50 max-w-2xl w-full text-center"
        >
          <div className="bg-green-100 w-24 h-24 rounded-full flex items-center justify-center mx-auto mb-8">
            <CheckCircle2 className="h-12 w-12 text-green-600" />
          </div>
          <h1 className="text-4xl font-black text-coffee-950 mb-4 tracking-tight">Order Placed Successfully!</h1>
          <p className="text-coffee-500 text-lg mb-4 font-medium leading-relaxed">
            Thank you for your GCash payment! Our baristas are now preparing your fresh coffee.
          </p>
          <p className="text-coffee-400 text-sm mb-10">Your order will be delivered via <span className="font-bold text-coffee-700">Lalamove</span>. Track it in "My Orders".</p>
          <div className="flex flex-col sm:flex-row items-center justify-center gap-4">
            <Link href="/dashboard" className="w-full sm:w-auto bg-coffee-950 text-white px-10 py-5 rounded-2xl font-black transition-all hover:bg-coffee-800 shadow-xl">
              Go to Dashboard
            </Link>
            <Link href="/orders" className="w-full sm:w-auto bg-cream-100 text-[#C69276] px-10 py-5 rounded-2xl font-black transition-all hover:bg-cream-200">
              View My Orders
            </Link>
          </div>
        </motion.div>
      </div>
    );
  }

  if (cart.length === 0) {
    return (
        <div className="min-h-[80vh] flex items-center justify-center">
            <div className="text-center">
                <ShoppingBag className="mx-auto h-16 w-16 text-coffee-100 mb-6" />
                <h2 className="text-2xl font-bold text-coffee-950 mb-4">Your cart is empty</h2>
                <Link href="/menu" className="text-[#C69276] font-bold hover:underline">Back to Menu</Link>
            </div>
        </div>
    );
  }

  return (
    <div className="max-w-6xl mx-auto py-12 px-6">
      <div className="flex items-center space-x-4 mb-12">
        <Link href="/cart" className="p-3 bg-white border border-coffee-100 rounded-2xl hover:bg-cream-50 transition-all shadow-sm">
          <ArrowLeft className="h-5 w-5 text-coffee-900" />
        </Link>
        <div>
          <h1 className="text-4xl font-black text-coffee-950 leading-none">Checkout</h1>
          <p className="text-coffee-400 font-medium mt-1">Complete your order details</p>
        </div>
      </div>

      <div className="grid grid-cols-1 lg:grid-cols-2 gap-16">
        {/* Left: Form */}
        <div>
          <form id="checkout-form" onSubmit={handleSubmit} className="space-y-8">
            {/* Delivery Info */}
            <div className="bg-white p-10 rounded-[2.5rem] border border-coffee-50 shadow-sm space-y-8">
              <h2 className="text-2xl font-black text-coffee-950 flex items-center space-x-3">
                 <div className="w-10 h-10 bg-cream-50 rounded-xl flex items-center justify-center">
                    <MapPin className="h-5 w-5 text-[#C69276]" />
                 </div>
                 <span>Delivery Information</span>
              </h2>

              <div className="space-y-6">
                <div className="space-y-2">
                  <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">Full Name</label>
                  <div className="relative">
                    <User className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-coffee-200" />
                    <input 
                      required
                      type="text" 
                      name="name"
                      value={formData.name}
                      onChange={handleInputChange}
                      placeholder="e.g. John Doe"
                      className="w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10 transition-all"
                    />
                  </div>
                </div>

                <div className="space-y-2">
                  <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">Contact Number</label>
                  <div className="relative">
                    <Phone className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-coffee-200" />
                    <input 
                      required
                      type="tel" 
                      name="phone"
                      value={formData.phone}
                      onChange={handleInputChange}
                      placeholder="e.g. 09123456789"
                      className="w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10 transition-all"
                    />
                  </div>
                </div>

                <div className="space-y-2">
                  <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">Delivery Address</label>
                  <div className="relative">
                    <MapPin className="absolute left-4 top-4 h-4 w-4 text-coffee-200" />
                    <textarea 
                      required
                      rows={3}
                      name="address"
                      value={formData.address}
                      onChange={handleInputChange}
                      placeholder="Street, Building, Room/Floor, Landmark"
                      className="w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-[#C69276]/10 transition-all resize-none"
                    ></textarea>
                  </div>
                </div>
              </div>
            </div>

            {/* Lalamove Shipping */}
            <div className="bg-white p-10 rounded-[2.5rem] border border-coffee-50 shadow-sm space-y-6">
               <h2 className="text-2xl font-black text-coffee-950 flex items-center space-x-3">
                 <div className="w-10 h-10 bg-orange-50 rounded-xl flex items-center justify-center">
                    <Truck className="h-5 w-5 text-orange-500" />
                 </div>
                 <span>Shipping via Lalamove</span>
               </h2>

               <p className="text-sm text-coffee-400 leading-relaxed">
                 Select your delivery area to calculate the shipping fee. Delivery is powered by <span className="font-bold text-orange-500">Lalamove</span> for fast and reliable service.
               </p>

               <div className="space-y-2">
                 <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">Select Your Area</label>
                 <div className="relative">
                   <Navigation className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-orange-400" />
                   <select
                     required
                     value={selectedLocation}
                     onChange={(e) => setSelectedLocation(e.target.value)}
                     className="w-full appearance-none bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 pl-12 pr-6 outline-none focus:ring-4 focus:ring-orange-100 transition-all cursor-pointer font-medium text-coffee-800"
                   >
                     <option value="">— Pin your location —</option>
                     {presetLocations.map(loc => (
                       <option key={loc.name} value={loc.name}>
                         📍 {loc.name} {loc.distance > 0 ? `(~${loc.distance} km)` : ''}
                       </option>
                     ))}
                   </select>
                 </div>
               </div>

               {selectedLocation === 'Other Location' && (
                 <div className="space-y-2">
                   <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">Estimated Distance (km)</label>
                   <input
                     type="number"
                     min="0"
                     step="0.5"
                     value={customDistance}
                     onChange={(e) => setCustomDistance(e.target.value)}
                     placeholder="e.g. 8"
                     className="w-full bg-cream-50/30 border border-coffee-50 rounded-2xl py-4 px-6 outline-none focus:ring-4 focus:ring-orange-100 transition-all"
                   />
                 </div>
               )}

               {shippingFee > 0 && (
                 <div className="bg-orange-50 border border-orange-200 rounded-2xl p-4 flex items-center justify-between">
                   <div className="flex items-center space-x-3">
                     <Truck className="h-5 w-5 text-orange-500" />
                     <span className="font-bold text-coffee-800 text-sm">Lalamove Delivery Fee</span>
                   </div>
                   <span className="font-black text-orange-600 text-lg">₱{shippingFee.toFixed(2)}</span>
                 </div>
               )}

               {/* Rate table */}
               <div className="bg-cream-50/50 rounded-xl p-4">
                 <p className="text-[10px] font-black uppercase tracking-widest text-coffee-300 mb-3">Shipping Rate Table</p>
                 <div className="grid grid-cols-2 gap-1 text-xs">
                   {shippingRates.map(r => (
                     <div key={r.label} className="flex justify-between py-1 px-2 rounded">
                       <span className="text-coffee-500">{r.label}</span>
                       <span className="font-bold text-coffee-700">₱{r.fee}</span>
                     </div>
                   ))}
                 </div>
               </div>
            </div>

            {/* GCash Payment */}
            <div className="bg-white p-10 rounded-[2.5rem] border border-coffee-50 shadow-sm space-y-6">
               <h2 className="text-2xl font-black text-coffee-950 flex items-center space-x-3">
                 <div className="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center overflow-hidden">
                    <img src="/images/gcash-logo.png" alt="GCash" className="w-8 h-8 object-contain" />
                 </div>
                 <span>Pay with GCash</span>
               </h2>

               <div className="bg-[#007DFE]/5 border-2 border-[#007DFE]/20 rounded-2xl p-6 space-y-4">
                 <div className="flex items-center space-x-4">
                   <div className="w-16 h-16 bg-white rounded-xl border border-[#007DFE]/10 flex items-center justify-center overflow-hidden flex-shrink-0">
                     <img src="/images/gcash-logo.png" alt="GCash" className="w-12 h-12 object-contain" />
                   </div>
                   <div>
                     <p className="font-black text-coffee-950">GCash Payment</p>
                     <p className="text-sm text-coffee-400">Send your payment to the number below:</p>
                     <p className="text-2xl font-black text-[#007DFE] mt-1">0912 345 6789</p>
                     <p className="text-xs text-coffee-400 mt-1">Account Name: <span className="font-bold">NextCafe Coffee Shop</span></p>
                   </div>
                 </div>

                 <div className="border-t border-[#007DFE]/10 pt-4 text-sm text-coffee-500 space-y-1">
                   <p>📱 Open your GCash app → Send Money</p>
                   <p>💰 Send exact amount: <span className="font-black text-[#007DFE]">₱{(subtotal + shippingFee).toFixed(2)}</span></p>
                   <p>📋 Enter reference number below after payment</p>
                 </div>

                 <div className="space-y-2">
                   <label className="text-[10px] font-black uppercase tracking-widest text-coffee-300 ml-1">GCash Reference Number</label>
                   <input
                     required
                     type="text"
                     name="gcashRef"
                     value={formData.gcashRef}
                     onChange={handleInputChange}
                     placeholder="e.g. 1234 5678 9012"
                     className="w-full bg-white border-2 border-[#007DFE]/20 rounded-2xl py-4 px-6 outline-none focus:ring-4 focus:ring-[#007DFE]/10 transition-all font-bold text-lg tracking-wider"
                   />
                 </div>
               </div>

               <p className="text-xs text-coffee-400 text-center">
                 🔒 We only accept GCash — the most common payment method for students. Secure and hassle-free.
               </p>
            </div>
          </form>
        </div>

        {/* Right: Order Summary */}
        <div className="space-y-8">
           <div className="bg-[#2D1B14] p-10 rounded-[3rem] text-white shadow-2xl">
              <h2 className="text-2xl font-black mb-8 italic uppercase tracking-widest">Your Order</h2>
              
              <div className="space-y-6 mb-10 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                {cart.map((item) => (
                  <div key={item.id} className="flex items-center justify-between group">
                    <div className="flex items-center space-x-4">
                      <div className="w-12 h-12 rounded-xl overflow-hidden bg-white/10 flex-shrink-0">
                        <img src={item.image} alt={item.name} className="w-full h-full object-cover" />
                      </div>
                      <div>
                        <p className="font-bold text-sm text-white group-hover:text-[#D4A373] transition-colors">{item.name}</p>
                        {item.customLabel && (
                          <p className="text-[10px] text-white/40 mt-0.5">{item.customLabel}</p>
                        )}
                        <p className="text-xs text-white/40">Qty: {item.quantity}</p>
                      </div>
                    </div>
                    <span className="font-bold text-white/90 italic">₱{(item.price * item.quantity).toFixed(2)}</span>
                  </div>
                ))}
              </div>

              <div className="space-y-4 border-t border-white/10 pt-8 mt-10">
                <div className="flex justify-between text-white/60 font-medium">
                  <span>Items Subtotal</span>
                  <span>₱{subtotal.toFixed(2)}</span>
                </div>
                <div className="flex justify-between text-white/60 font-medium">
                  <span className="flex items-center space-x-2">
                    <Truck className="h-4 w-4" />
                    <span>Lalamove Shipping</span>
                  </span>
                  <span>{shippingFee > 0 ? `₱${shippingFee.toFixed(2)}` : '—'}</span>
                </div>
                <div className="flex justify-between text-white/60 font-medium">
                  <span className="flex items-center space-x-2">
                    <img src="/images/gcash-logo.png" alt="GCash" className="h-4 w-4 object-contain rounded" />
                    <span>Payment</span>
                  </span>
                  <span className="text-[#007DFE]">GCash</span>
                </div>
                <div className="flex justify-between text-3xl font-black pt-4 border-t border-white/5">
                  <span className="italic uppercase">Total</span>
                  <span className="text-[#D4A373]">₱{(subtotal + shippingFee).toFixed(2)}</span>
                </div>
              </div>

              <button 
                form="checkout-form"
                type="submit"
                disabled={loading || !formData.gcashRef || shippingFee === 0}
                className="w-full bg-[#007DFE] text-white py-6 rounded-2xl font-black text-xl hover:bg-[#0066CC] transition-all shadow-2xl mt-10 active:scale-95 disabled:opacity-50 disabled:scale-100 flex items-center justify-center space-x-3"
              >
                <img src="/images/gcash-logo.png" alt="" className="h-6 w-6 object-contain rounded" />
                <span>{loading ? 'Processing...' : 'CONFIRM & PAY VIA GCASH'}</span>
              </button>
              
              <p className="text-center text-white/30 text-[10px] mt-8 uppercase tracking-widest font-black">
                NextCafe • Powered by GCash & Lalamove
              </p>
           </div>

           <div className="bg-cream-50 p-8 rounded-[2.5rem] border border-dashed border-coffee-100 text-center">
              <ShoppingBag className="h-8 w-8 text-coffee-200 mx-auto mb-4" />
              <p className="text-coffee-400 font-medium text-sm leading-relaxed px-6">
                Make sure you&apos;ve sent the correct GCash amount and entered the reference number before confirming.
              </p>
           </div>
        </div>
      </div>
    </div>
  );
}
