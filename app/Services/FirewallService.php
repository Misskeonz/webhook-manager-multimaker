<?php

namespace App\Services;

use Exception;

class FirewallService
{
    /**
     * Get UFW status
     */
    public function getUfwStatus(): array
    {
        try {
            $output = shell_exec('sudo ufw status verbose 2>&1');
            
            if (strpos($output, 'Status: active') !== false) {
                return [
                    'enabled' => true,
                    'output' => $output
                ];
            }
            
            return [
                'enabled' => false,
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'enabled' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Enable UFW
     */
    public function enableUfw(): array
    {
        try {
            // Enable UFW with --force to skip prompts
            $output = shell_exec('sudo ufw --force enable 2>&1');
            
            return [
                'success' => true,
                'message' => 'Firewall enabled successfully',
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Disable UFW
     */
    public function disableUfw(): array
    {
        try {
            $output = shell_exec('sudo ufw disable 2>&1');
            
            return [
                'success' => true,
                'message' => 'Firewall disabled successfully',
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Add firewall rule
     */
    public function addRule($action, $port = null, $protocol = null, $fromIp = null, $direction = 'in'): array
    {
        try {
            $command = "sudo ufw {$action}";
            
            if ($direction && $direction !== 'both') {
                $command .= " {$direction}";
            }
            
            if ($port) {
                $command .= " {$port}";
            }
            
            if ($protocol) {
                $command .= "/{$protocol}";
            }
            
            if ($fromIp) {
                $command .= " from {$fromIp}";
            }
            
            $output = shell_exec($command . ' 2>&1');
            
            // Reload UFW to apply changes
            shell_exec('sudo ufw reload 2>&1');
            
            return [
                'success' => true,
                'message' => 'Rule added successfully',
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Delete firewall rule
     */
    public function deleteRule($ruleNumber): array
    {
        try {
            $output = shell_exec("sudo ufw --force delete {$ruleNumber} 2>&1");
            
            return [
                'success' => true,
                'message' => 'Rule deleted successfully',
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Reset UFW (delete all rules)
     */
    public function resetUfw(): array
    {
        try {
            $output = shell_exec('sudo ufw --force reset 2>&1');
            
            return [
                'success' => true,
                'message' => 'Firewall reset successfully',
                'output' => $output
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }
}
