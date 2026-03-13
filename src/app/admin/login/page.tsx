"use client";
import React, { useState } from 'react';
import { motion } from 'framer-motion';
import { Shield, Lock, ArrowLeft } from 'lucide-react';
import { useRouter } from 'next/navigation';
import Link from 'next/link';

export default function AdminLoginPage() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [error, setError] = useState('');
  const [loading, setLoading] = useState(false);
  const router = useRouter();

  const handleLogin = async (e: React.FormEvent) => {
    e.preventDefault();
    setError('');
    setLoading(true);
    
    try {
      const response = await fetch('/api/login', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ email, password }),
      });

      const data = await response.json();

      if (response.ok) {
        if (data.user.role === 'admin') {
          localStorage.setItem('user_name', data.user.name || 'Admin');
          localStorage.setItem('user_email', data.user.email);
          localStorage.setItem('user_role', 'admin');
          router.push('/admin');
        } else {
          setError('Access denied. This portal is for administrators only.');
        }
      } else {
        setError(data.error || 'Invalid credentials');
      }
    } catch (err) {
      console.error(err);
      setError('An error occurred. Please try again.');
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="min-h-screen w-full flex items-center justify-center bg-[#1A110D] p-4 md:p-8">
      {/* Main Container */}
      <motion.div 
        initial={{ opacity: 0, scale: 0.98 }}
        animate={{ opacity: 1, scale: 1 }}
        className="w-full max-w-5xl bg-white rounded-[2.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.8)] flex flex-col md:flex-row min-h-[600px]"
      >
        {/* Left Side: Dark Info & Image */}
        <div className="w-full md:w-[45%] bg-[#1A110D] relative overflow-hidden flex flex-col justify-center p-12 text-white">
          {/* Admin Image Overlay */}
          <div className="absolute inset-0 z-0">
            <img 
              src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?q=80&w=1200&auto=format&fit=crop" 
              alt="Admin Background"
              className="w-full h-full object-cover opacity-30"
            />
            <div className="absolute inset-0 bg-gradient-to-t from-[#1A110D] via-transparent to-transparent"></div>
          </div>

          <div className="relative z-10">
            {/* Logo */}
            <div className="mb-8">
              <img src="/images/logo.png" alt="NextCafe" className="w-40 h-auto drop-shadow-2xl" />
            </div>

            <div className="flex items-center space-x-3 mb-6">
              <div className="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
                <Shield className="h-5 w-5 text-red-400" />
              </div>
              <span className="text-sm font-black uppercase tracking-[0.3em] text-red-400">Admin Portal</span>
            </div>

            <h2 className="text-5xl font-black mb-6 leading-tight tracking-tight">
              Management Console
            </h2>
            
            <p className="text-cream-100/70 text-lg leading-relaxed font-medium max-w-sm">
              Authorized personnel only. Access the dashboard to manage products, categories, and user accounts.
            </p>
          </div>
        </div>

        {/* Right Side: White Login Form */}
        <div className="w-full md:w-[55%] bg-white p-12 md:p-20 flex flex-col justify-center">
          <div className="max-w-md mx-auto w-full">
            <Link href="/login" className="flex items-center space-x-2 text-coffee-400 hover:text-coffee-900 transition-colors mb-8 font-medium text-sm group">
              <ArrowLeft className="h-4 w-4 group-hover:-translate-x-1 transition-transform" />
              <span>Back to User Login</span>
            </Link>

            <h3 className="text-2xl font-black text-coffee-950 mb-4 uppercase tracking-widest">
              ADMIN LOGIN
            </h3>
            <p className="text-coffee-400 text-sm mb-10 font-medium">Please enter your credentials to continue</p>

            {/* Error Message */}
            {error && (
              <motion.div 
                initial={{ opacity: 0, y: -10 }}
                animate={{ opacity: 1, y: 0 }}
                className="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-8 text-center"
              >
                <p className="text-red-600 text-sm font-bold">{error}</p>
              </motion.div>
            )}

            <form onSubmit={handleLogin} className="space-y-8">
              {/* Email Field */}
              <div className="space-y-3">
                <div className="flex items-center space-x-2 text-coffee-400">
                  <Shield className="h-5 w-5" />
                  <span className="text-[10px] font-black uppercase tracking-widest">Admin Email</span>
                </div>
                <input 
                  type="email" 
                  required
                  placeholder="admin@nextcafe.com"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className="w-full bg-white border border-coffee-100 rounded-xl py-4 px-6 text-coffee-950 outline-none focus:border-[#D4A373] focus:ring-4 focus:ring-[#D4A373]/5 transition-all placeholder:text-coffee-200"
                />
              </div>

              {/* Password Field */}
              <div className="space-y-3">
                <div className="flex items-center space-x-2 text-coffee-400">
                  <Lock className="h-5 w-5" />
                  <span className="text-[10px] font-black uppercase tracking-widest">Security Password</span>
                </div>
                <input 
                  type="password" 
                  required
                  placeholder="Password"
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="w-full bg-white border border-coffee-100 rounded-xl py-4 px-6 text-coffee-950 outline-none focus:border-[#D4A373] focus:ring-4 focus:ring-[#D4A373]/5 transition-all placeholder:text-coffee-200"
                />
              </div>

              {/* Login Button */}
              <button 
                type="submit"
                disabled={loading}
                className="w-full bg-red-600 text-white py-5 rounded-xl font-black text-lg uppercase tracking-widest hover:bg-red-700 transition-all shadow-xl shadow-red-500/20 active:scale-[0.98] disabled:opacity-50 disabled:scale-100"
              >
                {loading ? 'Verifying...' : 'SIGN IN AS ADMIN'}
              </button>
            </form>

            <div className="mt-10 border-t border-coffee-50 pt-10">
              <p className="text-cream-100/40 text-[10px] font-black uppercase tracking-widest text-center">
                NextCafe security protocol v2.4
              </p>
            </div>
          </div>
        </div>
      </motion.div>
    </div>
  );
}
