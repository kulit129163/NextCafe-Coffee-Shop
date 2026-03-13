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
    <div className="min-h-screen w-full flex items-center justify-center bg-[#1A110D] p-4 md:p-8 relative overflow-hidden">
      {/* Background Pattern */}
      <div className="absolute inset-0 opacity-5">
        <div className="absolute inset-0" style={{
          backgroundImage: `radial-gradient(circle at 25% 25%, #C69276 1px, transparent 1px), radial-gradient(circle at 75% 75%, #C69276 1px, transparent 1px)`,
          backgroundSize: '40px 40px'
        }}></div>
      </div>
      
      {/* Glow Effects */}
      <div className="absolute top-1/4 left-1/4 w-96 h-96 bg-[#C69276]/10 rounded-full blur-[100px]"></div>
      <div className="absolute bottom-1/4 right-1/4 w-80 h-80 bg-red-900/10 rounded-full blur-[80px]"></div>

      <motion.div 
        initial={{ opacity: 0, y: 20, scale: 0.98 }}
        animate={{ opacity: 1, y: 0, scale: 1 }}
        transition={{ duration: 0.5 }}
        className="w-full max-w-lg relative z-10"
      >
        {/* Back to User Login Link */}
        <Link href="/login" className="flex items-center space-x-2 text-cream-100/40 hover:text-white transition-colors mb-8 font-medium text-sm group">
          <ArrowLeft className="h-4 w-4 group-hover:-translate-x-1 transition-transform" />
          <span>Back to User Login</span>
        </Link>

        {/* Admin Card */}
        <div className="bg-gradient-to-b from-[#2D1B14] to-[#1A110D] rounded-[2.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(0,0,0,0.8)] border border-white/5">
          {/* Top Badge */}
          <div className="bg-gradient-to-r from-red-900/30 via-red-800/20 to-red-900/30 border-b border-white/5 p-6 flex items-center justify-center space-x-3">
            <div className="w-10 h-10 bg-red-500/20 rounded-xl flex items-center justify-center">
              <Shield className="h-5 w-5 text-red-400" />
            </div>
            <div>
              <span className="text-xs font-black uppercase tracking-[0.3em] text-red-400">Admin Portal</span>
              <p className="text-[10px] text-red-400/50 font-medium">Authorized Personnel Only</p>
            </div>
          </div>

          {/* Main Content */}
          <div className="p-10 md:p-14">
            {/* Logo */}
            <div className="flex justify-center mb-10">
              <div className="w-32 h-32 flex items-center justify-center">
                <img src="/images/logo.png" alt="NextCafe" className="w-full h-auto drop-shadow-2xl opacity-90" />
              </div>
            </div>

            <h2 className="text-3xl font-black text-white mb-2 text-center tracking-tight">Admin Login</h2>
            <p className="text-cream-100/40 text-sm text-center mb-10 font-medium">Sign in to manage your NextCafe dashboard</p>

            {/* Error Message */}
            {error && (
              <motion.div 
                initial={{ opacity: 0, y: -10 }}
                animate={{ opacity: 1, y: 0 }}
                className="bg-red-500/10 border border-red-500/20 rounded-xl p-4 mb-8 text-center"
              >
                <p className="text-red-400 text-sm font-bold">{error}</p>
              </motion.div>
            )}

            <form onSubmit={handleLogin} className="space-y-6">
              {/* Email */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-cream-100/30 ml-1">Admin Email</label>
                <div className="relative">
                  <Shield className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-cream-100/20" />
                  <input 
                    type="email" 
                    required
                    placeholder="admin@nextcafe.com"
                    value={email}
                    onChange={(e) => setEmail(e.target.value)}
                    className="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-6 text-white outline-none focus:border-[#C69276]/50 focus:ring-4 focus:ring-[#C69276]/10 transition-all placeholder:text-cream-100/15"
                  />
                </div>
              </div>

              {/* Password */}
              <div className="space-y-2">
                <label className="text-[10px] font-black uppercase tracking-widest text-cream-100/30 ml-1">Password</label>
                <div className="relative">
                  <Lock className="absolute left-4 top-1/2 -translate-y-1/2 h-4 w-4 text-cream-100/20" />
                  <input 
                    type="password" 
                    required
                    placeholder="••••••••"
                    value={password}
                    onChange={(e) => setPassword(e.target.value)}
                    className="w-full bg-white/5 border border-white/10 rounded-xl py-4 pl-12 pr-6 text-white outline-none focus:border-[#C69276]/50 focus:ring-4 focus:ring-[#C69276]/10 transition-all placeholder:text-cream-100/15"
                  />
                </div>
              </div>

              {/* Login Button */}
              <button 
                type="submit"
                disabled={loading}
                className="w-full bg-gradient-to-r from-[#C69276] to-[#A97B62] text-white py-5 rounded-xl font-black text-lg uppercase tracking-widest hover:from-[#b68a5d] hover:to-[#9A6D56] transition-all shadow-xl shadow-[#C69276]/10 active:scale-[0.98] disabled:opacity-50 disabled:scale-100"
              >
                {loading ? 'Signing in...' : 'SIGN IN AS ADMIN'}
              </button>
            </form>

            <div className="mt-10 text-center">
              <p className="text-cream-100/20 text-xs font-medium">
                Not an admin? <Link href="/login" className="text-[#C69276] font-bold hover:underline">User Login</Link>
              </p>
            </div>
          </div>

          {/* Bottom Bar */}
          <div className="border-t border-white/5 px-10 py-4 flex items-center justify-center">
            <p className="text-cream-100/15 text-[10px] font-black uppercase tracking-widest">
              NextCafe Admin Console © 2026
            </p>
          </div>
        </div>
      </motion.div>
    </div>
  );
}
