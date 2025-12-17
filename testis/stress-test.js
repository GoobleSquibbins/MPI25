
import http from 'k6/http';
import { check, sleep } from 'k6';
import { SharedArray } from 'k6/data';
import { ENDPOINTS } from './config.js';

const users = new SharedArray('users', function () {
    return JSON.parse(open('./users.json')).users;
});

export const options = {
    scenarios: {
        stress_test: {
            executor: 'constant-arrival-rate',
            rate: 400, // 400 TPS
            timeUnit: '1s',
            duration: '10m',
            preAllocatedVUs: 1000,
            maxVUs: 1200,
        },
    },
    thresholds: {
        http_req_failed: ['rate<0.05'], // Allow a slightly higher failure rate
        http_req_duration: ['p(95)<1000'],
    },
};

export default function () {
    const user = users[Math.floor(Math.random() * users.length)];

    const loginRes = http.post(ENDPOINTS.LOGIN, {
        name: user.name,
        password: 'qwe',
    });

    check(loginRes, {
        'login successful under stress': (res) => res.status === 200,
    });

    if (loginRes.status === 200) {
        http.get(ENDPOINTS.DASHBOARD);
        sleep(1);
        http.get(ENDPOINTS.BOOKS);
    }

    sleep(0.5);
}
